<?php

namespace BniApi\BniPhp\net;

use BniApi\BniPhp\utils\Util;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class HttpClient
{
    public $utils;
    public $client;

    public function __construct()
    {
        $this->utils = new Util;
        $this->client = new Client();
    }

    public function request(
        string $method,
        string $url,
        array $headers,
        array $data
    ) {
        try {

            $header = [
                'user-agent' => 'bni-php/0.1.0',
            ];

            $headers = array_merge($header, $headers);
            $request = new Request($method, $url, $headers);
            $res = $this->client->sendAsync($request, $data)->wait();
            return $res;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            } else {
                return new Exception($e->getMessage(), 503);
            }
        }
    }
}
