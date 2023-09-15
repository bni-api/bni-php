<?php

namespace BniApi\BniPhp;

use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class Bni
{

    public $env;
    public $appName;
    public $clientId;
    public $clientSecret;
    public $apiKey;
    public $apiSecret;

    private $client;
    
    const SANDBOX_BASE_URL = "https://sandbox.bni.co.id";
    const DEV_BASE_URL = "https://newapidev.bni.co.id:8066";
    const UAT_BASE_URL = "https://newapidev.bni.co.id:8065";
    const PRODUCTION_BASE_URL = "https://api.bni.co.id";

    const SANDBOX_TUNNELING_BASE_URL = "https://sb-dev-in.dglapm.id";
    const DEV_TUNNELING_BASE_URL = "https://dev-in.dglapm.id";

    const ENV_DEV = 'dev'; // ngarah ke DEV_BASE_URL
    const ENV_DEV_2 = 'dev-2'; // ngarah ke DEV_TUNNELING_BASE_URL || ok
    const ENV_UAT = 'uat'; // UAT_BASE_URL || ok
    const ENV_SANDBOX = 'sandbox'; // SANDBOX_BASE_URL || ok
    const ENV_SANDBOX_2 = 'sandbox-2'; // SANDBOX_TUNNELING_BASE_URL || ok
    const ENV_PRODUCTION = 'prod'; // PRODUCTION_BASE_URL || ok


    function __construct(string $env, $clientId, $clientSecret, $apiKey, $apiSecret, $appName)
    {
        $this->env = $env;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->appName = $appName;
        $this->client = new HttpClient;
    }

    public function getBaseUrl()
    {
        $baseUrl = self::PRODUCTION_BASE_URL;
        if ($this->env === self::ENV_DEV) 
            $baseUrl = self::DEV_BASE_URL;
        else if ($this->env === self::ENV_SANDBOX) 
            $baseUrl = self::SANDBOX_BASE_URL;
        else if ($this->env === self::ENV_UAT) 
            $baseUrl = self::UAT_BASE_URL;
        else if ($this->env === self::ENV_PRODUCTION) 
            $baseUrl = self::PRODUCTION_BASE_URL;
        else if ($this->env === self::ENV_DEV_2) 
            $baseUrl = self::DEV_TUNNELING_BASE_URL;
        else if ($this->env === self::ENV_SANDBOX_2) 
            $baseUrl = self::SANDBOX_TUNNELING_BASE_URL;
        return $baseUrl;
    }

    public function getToken()
    {
        try {
            $url = $this->getBaseUrl(). Constant::URL_GET_TOKEN;

            $header = [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ":" . $this->clientSecret)
            ];
            $data = [
                RequestOptions::FORM_PARAMS => [
                    'grant_type' => 'client_credentials'
                ]
            ];

            $response = $this->client->request('POST', $url, $header, $data);
            return json_decode($response->getBody())->access_token;
        } catch (ClientException $th) {
            throw new Exception(Constant::ERROR_GET_TOKEN);
        }
    }
}
