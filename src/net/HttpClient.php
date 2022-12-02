<?php

namespace BniApi\BniPhp\net;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;

class HttpClient
{

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
        ]);
    }

    public function request(
        string $apiKey,
        string $accessToken,
        string $url,
        array $data
    ) {
        $headers = [
            'X-API-Key' => $apiKey,
            'user-agent' => 'bni-php/0.1.0',
        ];
        $options = [
            RequestOptions::JSON => $data
        ];
        $request = new Request('POST', $url . '?access_token=' . $accessToken, $headers);
        $res = $this->client->sendAsync($request, $options)->wait();
        return json_decode($res->getBody());
    }

    public function requestSnapBI(
        string $accessToken,
        string $url,
        array $data,
        array $additionalHeaders
    ) {
        $header = [
            'user-agent' => 'bni-php/0.1.0',
            'Authorization' => $accessToken
        ];
        $headers = array_merge($header, $additionalHeaders);

        $options = [
            RequestOptions::JSON => $data
        ];
        $request = new Request('POST', $url, $headers);
        $res = $this->client->sendAsync($request, $options)->wait();
        return json_decode($res->getBody());



        // $header = [
        //     'user-agent' => 'bni-php/0.1.0',
        // ];

        // $headers = array_merge($header, $additionalHeaders);
        // $response = Http::withHeaders($headers)
        //     ->withToken($accessToken)
        //     ->post($url, $data);

        // return $response;
    }

    public function requestTokenSnap()
    {
        
    }
    
}
