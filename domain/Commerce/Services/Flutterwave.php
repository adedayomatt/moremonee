<?php
namespace Domain\Commerce\Services;

use Carbon\Carbon;
use Domain\Commerce\Models\ExternalServiceRequest;
use Flutterwave\CardPayment;

class Flutterwave {

    Const BASE_URL = "https://api.flutterwave.com/v3/";
    Const SERVICE_NAME = "flutterwave";
    Const AUTH_OTP = "otp";
    Const AUTH_REDIRECT = "redirect";
    Const AUTH_PIN = "pin";
    Const AUTH_ADDRESS = "avs_noauth";

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

    public static function authActions(){
        $action = [];
        $action[Flutterwave::AUTH_ADDRESS] = "verify_address";
        $action[Flutterwave::AUTH_PIN] = "pin";
        $action[Flutterwave::AUTH_OTP] = "otp";
        $action[Flutterwave::AUTH_REDIRECT] = "redirect";
        return $action;
    }

    /**
     * @param $payload
     * @return string
     */
    public static function encryptPayload($payload) {
        $encrypted = openssl_encrypt(json_encode($payload), 'DES-EDE3', config('services.flutterwave.encryption_key'), OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }

    /**
     * @param $data
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createCharge($data = []) {
        if(empty($data['tx_ref'])) $data['tx_ref'] = self::generateTxRef();
        $client = new Http(self::BASE_URL, self::headers(), self::SERVICE_NAME, "create-charge", $data["tx_ref"]);
        return $client->post("charges", [
            "query" => ["type" => "card"],
            "json" => [
                "client" => self::encryptPayload($data)
            ]
        ]);
    }

    /**
     * @param $reference
     * @param $data
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    /**
     * @param $reference
     * @param $data
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function OtpValidation($reference, $data) {
        $client = new Http(self::BASE_URL, self::headers(), self::SERVICE_NAME, "validate-otp", $reference);
        return $client->post("validate-charge", [
            "json" => $data
        ]);
    }

    /**
     * @param $reference
     * @param $id
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function verifyCharge($reference, $id) {
        $client = new Http(self::BASE_URL, self::headers(), self::SERVICE_NAME, "verify-charge", $reference);
        return $client->get("transactions/$id/verify");
    }
}
