<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\ExternalServiceRequest;
use Domain\Commerce\Services\Flutterwave;
use Illuminate\Http\Request;

class GetFlwCallback extends Controller
{

    public function __invoke(Request $request)
    {
        $data = json_decode($request->response);
        ExternalServiceRequest::create([
            "service" => Flutterwave::SERVICE_NAME,
            "activity" => "callback",
            "reference" => $data->txRef,
            "method" => $request->method(),
            "url" => $request->url(),
            "request" => json_encode($data) ,
            "headers" => json_encode($request->header()),
            "response" => null,
        ]);
        return view("callback.flw")->with("data", $data);
    }

}
