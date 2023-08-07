<?php

namespace BniApi\BniPhp\utils;

class Util
{
    public function generateClientId(string $clientId)
    {
        return 'IDBNI' . base64_encode($clientId);
    }

    public function generateSignature(array $payload, string $apiSecret)
    {
        $header = JSON_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $payload = JSON_encode($payload);
        $base64UrlHeader = $this->escapeString(base64_encode($header));
        $base64UrlPayload = $this->escapeString(base64_encode($payload));
        $signature = hash_hmac(
            'sha256',
            $base64UrlHeader . "." . $base64UrlPayload,
            $apiSecret,
            true
        );
        $base64UrlSignature = $this->escapeString(base64_encode($signature));
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public function generateSignatureV2(array $payload, string $apiSecret, string $time)
    {
        $header = JSON_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);
        
        $timeStamp = [
            "timestamp" => $time
        ];
        $data = array_merge($payload, $timeStamp);
        $payloadData = JSON_encode($data);
        $base64UrlHeader = $this->escapeString(base64_encode($header));
        $base64UrlPayload = $this->escapeString(base64_encode($payloadData));
        $signature = hash_hmac(
            'sha256',
            $base64UrlHeader . "." . $base64UrlPayload,
            $apiSecret,
            true
        );
        $base64UrlSignature = $this->escapeString(base64_encode($signature));
        return $base64UrlSignature;
    }

    public function generateUUID($length = 16)
    {
        $randomString = strtoupper(bin2hex(random_bytes($length/2)));
        return $randomString;
    }

    public function escapeString(string $string)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            $string
        );
    }

    public function getTimeStamp()
    {
        date_default_timezone_set('Asia/Jakarta');
        return date('c');
    }

    public function generateSignatureSnapBI(string $clientId, string $privateKeyPath, string $timeStamp)
    {
        $privateKey = file_get_contents($privateKeyPath);

        $data = $clientId . '|' . $timeStamp;
        $binary_signature = "";

        $algo = "SHA256";
        openssl_sign($data, $binary_signature, $privateKey, $algo);
        return base64_encode($binary_signature);
    }

    public function generateSignatureServiceSnapBI(string $method, array $body, string $url, string $accessToken, string $timeStamp, string $apiSecret)
    {
        $requestBody = json_encode($body);
        $hash = hash('sha256', $requestBody);
        $stringToSign = $method . ':' . $url . ':' . $accessToken . ':' . strtolower($hash) . ':' . $timeStamp;

        $hmac = hash_hmac('sha512', $stringToSign, $apiSecret, true);
        return base64_encode($hmac);
    }

    public function randomNumber()
    {
        return rand(10, 100000000) . time();
    }
}
