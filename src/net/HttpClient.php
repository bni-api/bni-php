<?php

namespace BniApi\BniPhp\net;

use Illuminate\Support\Facades\Http;

class HttpClient
{

    public function request(
        string $apiKey,
        string $accessToken,
        string $url,
        array $data
    ) {
        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
            'user-agent' => 'bni-php/0.1.0',
        ])
            ->post($url . '?access_token=' . $accessToken, $data);

        return $response;
    }

    public function requestSnapBI(
        string $accessToken,
        string $url,
        array $data,
        array $additionalHeaders
    ) {
        $header = [
            'user-agent' => 'bni-php/0.1.0',
        ];

        $headers = array_merge($header, $additionalHeaders);
        $response = Http::withHeaders($headers)
            ->withToken($accessToken)
            ->post($url, $data);

        return $response;
    }
}
