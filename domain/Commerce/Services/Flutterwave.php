<?php
namespace Domain\Commerce\Services;

use Carbon\Carbon;
use Domain\Commerce\Constants\Constants;

class Flutterwave {

    Const SERVICE_NAME = "flutterwave";
    Const AUTH_OTP = "otp";
    Const AUTH_REDIRECT = "redirect";
    Const AUTH_PIN = "pin";
    Const AUTH_ADDRESS = "avs_noauth";

    /**
     * Flutterwave api base url
     *
     * @return String
     */
    public static function baseUrl() {
        return config('services.flutterwave.api_base_url');
    }

    /**
     * Headers for requests
     *
     * @return string[]
     */
    public static function headers() {
        return [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".config('services.flutterwave.secret_key')
        ];
    }

    /**
     * Generate transaction reference
     *
     * @return string
     */
    public static function generateTxRef() {
        return uniqid("FLW-".Carbon::now()->format("Ymdhmi")."-");
    }

    /**
     * Authentication mode mapped to actions required
     *
     * @return array
     */
    public static function authActions(){
        $action = [];
        $action[Flutterwave::AUTH_ADDRESS] = Constants::ACTION_ADDRESS;
        $action[Flutterwave::AUTH_PIN] = Constants::ACTION_PIN;
        $action[Flutterwave::AUTH_OTP] = Constants::ACTION_OTP;
        $action[Flutterwave::AUTH_REDIRECT] = Constants::ACTION_REDIRECT;
        return $action;
    }

    /**
     * @return \string[][]
     */
    public static function creditCardRules() {
        return [
            "name_on_card" => ["required", "string"],
            "card_number" => ["required", "numeric"],
            "expiry" => ["required", "regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/"],
            "cvv" => ["required", "regex:/[0-9]{3}/", "max:3"]
        ];
    }

    /**
     * @return \string[][]
     */
    public static function cardPinRules() {
        return [
            "card_pin" => ["required", "regex:/[0-9]{4}/", "max:4"]
        ];
    }

    /**
     * @return \string[][]
     */
    public static function otpRules() {
        return [
            "otp" => ["required"]
        ];
    }

    /**
     * @return \string[][]
     */
    public static function addressRules() {
        return [
            "address.city" => ["required"],
            "address.country" => ["required"],
            "address.state" => ["required"],
            "address.address" => ["required"],
            "address.zipcode" => ["required"]
        ];
    }

    /**
     * Authentication mode mapped to validation rules
     * @return array
     */
    public static function authenticationRules() {
        $auth = [];
        $auth[Flutterwave::AUTH_ADDRESS] = self::addressRules();
        $auth[Flutterwave::AUTH_PIN] = self::cardPinRules();
        $auth[Flutterwave::AUTH_OTP] = self::otpRules();
        $auth[Flutterwave::AUTH_REDIRECT] = [];
        return $auth;
    }

    /**
     *
     * Encryppt FLutterwave payload
     *
     * @param $payload
     * @return string
     */
    public static function encryptPayload($payload) {
        $encrypted = openssl_encrypt(json_encode($payload), 'DES-EDE3', config('services.flutterwave.encryption_key'), OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }

    /**
     * Create a charge
     * @param $data
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createCharge($data = []) {
        if(empty($data['tx_ref'])) $data['tx_ref'] = self::generateTxRef();
        $client = new Http(self::baseUrl(), self::headers(), self::SERVICE_NAME, "create-charge", $data["tx_ref"]);
        return $client->post("charges", [
            "query" => ["type" => "card"],
            "json" => [
                "client" => self::encryptPayload($data)
            ]
        ]);
    }

    /**
     * Validate charge with OTP
     *
     * @param $reference
     * @param $data
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function OtpValidation($reference, $data) {
        $client = new Http(self::baseUrl(), self::headers(), self::SERVICE_NAME, "validate-otp", $reference);
        return $client->post("validate-charge", [
            "json" => $data
        ]);
    }

    /**
     * Verify charge
     *
     * @param $reference
     * @param $id
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function verifyCharge($reference, $id) {
        $client = new Http(self::baseUrl(), self::headers(), self::SERVICE_NAME, "verify-charge", $reference);
        return $client->get("transactions/$id/verify");
    }

    /**
     * Get action required for a charge
     *
     * @param $charge
     * @return mixed|string|null
     */
    public static function actionRequiredForCharge($charge) {
        if(property_exists($charge, 'data') && $charge->data->status === Constants::STATUS_SUCCESSFUL) {
            return Constants::ACTION_VERIFY_TRANSACTION;
        }
        $authMode = self::chargeAuthMode($charge);
        return $authMode && !empty(self::authActions()[$authMode]) ? self::authActions()[$authMode] : null;
    }

    /**
     * Get charge auth mode
     *
     * @param $charge
     * @return mixed|null
     */
    public static function chargeAuthMode($charge) {
        return property_exists($charge, "meta") ? $charge->meta->authorization->mode : null;
    }

}
