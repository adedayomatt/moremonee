<?php
namespace Domain\Commerce\Actions;

use App\Classes\Utils;
use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\Order;
use Domain\Commerce\Models\Transaction;
use Domain\Commerce\Services\Flutterwave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class OrderPayment extends Controller
{
    public function __invoke(Request $request, $reference)
    {
        $order = Order::where("reference", $reference)->firstOrFail();
        $txRef = $request->get('transaction_reference', Flutterwave::generateTxRef());
        $this->validate($request, Flutterwave::creditCardRules());
        Utils::saveMemory($reference, [
            "transaction_reference" => $txRef,
            "card" => $request->only(array_keys(Flutterwave::creditCardRules()))
        ]);
        $authorization = [];
        if($request->auth_mode) {
            $authorization['mode'] = $request->auth_mode;
            $validator = Validator::make($request->all(), Flutterwave::authenticationRules()[$request->auth_mode]);
            if($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->with("transaction", Utils::getMemory($reference));
            }
            switch ($request->auth_mode) {
                case Flutterwave::AUTH_PIN:
                    $authorization["pin"] = $request->card_pin;
                    break;
                case Flutterwave::AUTH_ADDRESS:
                    $order = $order->updateBillingAddress($request->address);
                    $authorization["address"] = $order->billing->address->address;
                    $authorization["city"] = $order->billing->address->city->name;
                    $authorization["state"] = $order->billing->address->state->isoCode;
                    $authorization["country"] = $order->billing->address->country->isoCode;
                    $authorization["zipcode"] = $order->billing->address->zipcode;
                    break;
            }
        }
        $charge = Flutterwave::createCharge([
               "card_number" => $request->card_number,
               "cvv" => $request->cvv,
               "expiry_month" => explode("/", $request->expiry)[0],
               "expiry_year" => explode("/", $request->expiry)[1],
               "currency" => $order->currency,
               "amount" => $order->totalAmount,
               "fullname" => $order->billing->first_name." ".$order->billing->last_name,
               "email" => $order->email,
               "tx_ref" => $txRef,
               "redirect_url" => route("get.flw.callback"),
               "authorization" => $authorization
        ]);
        if($charge && $charge->status == Constants::STATUS_SUCCESS) {
            $transaction = null;
            if(property_exists($charge, "data")) {
                $transaction = $order->transactions()->updateOrCreate([
                    "reference" => $charge->data->tx_ref
                ],
                [
                    "amount" => $charge->data->amount,
                    "provider" => Flutterwave::SERVICE_NAME,
                    "provider_reference" => $charge->data->flw_ref,
                    "currency" => $charge->data->currency,
                    "metadata" => [
                        "chargeId" => $charge->data->id,
                        "card" => $charge->data->card,
                        "customer" => $charge->data->customer
                    ]
                ]);
            }
            Utils::saveMemory($reference, [
                "action_required" => Flutterwave::actionRequiredForCharge($charge),
                "auth_mode" => Flutterwave::chargeAuthMode($charge),
                "transaction" => $transaction
            ]);
            $redirect = redirect()->back();
            switch (Flutterwave::chargeAuthMode($charge)) {
                case Flutterwave::AUTH_OTP:
                    Utils::saveMemory($reference, [
                        "message" => $charge->data->processor_response,
                    ]);
                    break;
                case Flutterwave::AUTH_REDIRECT:
                    Utils::saveMemory($reference, [
                        "redirect" => $charge->meta->authorization->redirect,
                    ]);
                    break;
                case Flutterwave::AUTH_PIN:
                    Utils::saveMemory($reference, [
                        "message" => "Please provide card PIN",
                    ]);
                    if($request->card_pin) {
                        $redirect->with("toast", [
                            "type" => "error",
                            "message" => "Card validation failed, please check card details"
                        ]);
                    }
                    break;
                case Flutterwave::AUTH_ADDRESS:
                    Utils::saveMemory($reference, [
                        "message" => "Address verification is required, please confirm again the provided address is correct",
                    ]);
                    if($request->address) {
                        $redirect->with("toast", [
                            "type" => "error",
                            "message" => "Provided address verification failed, please check and try again"
                        ]);
                    }
                    break;
            }
            return $redirect->with("transaction", Utils::getMemory($reference));
        }

        return redirect()->back()
            ->with("transaction", Utils::getMemory($reference))
            ->with("toast", [
            "type" => "error",
            "message" => "Transaction failed. ".($charge && $charge->message ? $charge->message : ""),
            "stick" => true
        ]);
    }

}
