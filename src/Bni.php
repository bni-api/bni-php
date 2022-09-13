<?php

namespace BniApi\BniPhp;

use Exception;
use Illuminate\Support\Facades\Http;

class Bni
{

    public $prod;
    public $appName;
    public $clientId;
    public $clientSecret;
    public $apiKey;
    public $apiSecret;

    const SANBOX_BASE_URL = "https://newapidev.bni.co.id";
    const PRODUCTION_BASE_URL = "https://api.bni.co.id";

    function __construct(bool $prod, $clientId, $clientSecret, $apiKey, $apiSecret, $appName)
    {
        $this->prod = $prod;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->appName = $appName;
    }

    public function getBaseUrl()
    {
        return $this->prod ? self::PRODUCTION_BASE_URL : self::SANBOX_BASE_URL;
    }

    public function getToken()
    {
        $response = Http::withHeaders([
            'user-agent' => 'bni-php@0.1.0'
        ])
            ->asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->getBaseUrl()}/api/oauth/token", [
                'grant_type' => 'client_credentials'
            ]);

        if ($response->failed()) {
            throw new Exception($response->object()->error);
        }

        return $response->object()->access_token;
    }
}
