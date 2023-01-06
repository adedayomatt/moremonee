<?php
namespace Domain\Commerce\Services;

use Domain\Commerce\Models\ExternalServiceRequest;
use GuzzleHttp\Client;

class Http {
    protected $client;
    protected $log;

    public function __construct($baseUri, $headers = [], $service, $activity, $reference) {
        $this->client = new Client([
            "base_uri" => $baseUri,
            "headers" => $headers
        ]);
        $this->log = new ExternalServiceRequest();
        $this->log->url = $baseUri;
        $this->log->service = $service;
        $this->log->activity = $activity;
        $this->log->reference = $reference;
        $this->log->headers = json_encode($headers);
    }

    /**
     * @param $method
     * @param $url
     * @param $options
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $url, $options = []) {
        $this->log->url .= $url;
        $this->log->method = $method;
        $this->log->request = json_encode($options);
        $this->log->save();
        try {
            $response = $this->client->request($method, $url, $options);
            $responseBody = json_decode($response->getBody());
            $this->log->response = json_encode($responseBody);
            $this->log->save();
            return $responseBody;
        } catch (\Exception $e) {
            $this->log->response = $e->getMessage();
            $this->log->save();
            return false;
        }
    }

    /**
     * @param $url
     * @param $options
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($url, $options = []) {
        return $this->request("POST", $url, $options);
    }

    /**
     * @param $url
     * @param $options
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($url, $options = []) {
        return $this->request("GET", $url, $options);
    }

    /**
     * @param $url
     * @param $options
     * @return false|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($url, $options = []) {
        return $this->request("PUT", $url, $options);
    }



}
