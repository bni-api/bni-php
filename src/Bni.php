<?php

namespace BniApi\BniPhp;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class Bni
{

    public $prod;
    public $appName;
    public $clientId;
    public $clientSecret;
    public $apiKey;
    public $apiSecret;

    private $client;
    
    const SANBOX_BASE_URL = "https://dev.harismawan.com";
    const PRODUCTION_BASE_URL = "https://api.bni.co.id";

    function __construct(bool $prod, $clientId, $clientSecret, $apiKey, $apiSecret, $appName)
    {
        $this->prod = $prod;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->appName = $appName;
        $this->client = new Client([
            'verify' => false,
        ]);
    }

    public function getBaseUrl()
    {
        return $this->prod ? self::PRODUCTION_BASE_URL : self::SANBOX_BASE_URL;
    }

    public function getToken()
    {
        try {
            $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ":" . $this->clientSecret)
            ];
            $options = [
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ];
            $request = new Request('POST', "{$this->getBaseUrl()}/api/oauth/token", $headers);
            $res = $this->client->sendAsync($request, $options)->wait();
            return json_decode($res->getBody())->access_token;
        } catch (ClientException $th) {
            throw new Exception("error get token");
        }
    }
}
