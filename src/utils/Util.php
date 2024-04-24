<?php

namespace BniApi\BniPhp\utils;

use DateTime;
use DateTimeZone;

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
        $payload = stripslashes(JSON_encode($data));
        $base64UrlHeader = $this->escapeString(base64_encode($header));
        $base64UrlPayload = $this->escapeString(base64_encode($payload));
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

    public function getTimeStampBniMove()
    {
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $formattedTimestamp = $date->format('Y-m-d\TH:i:s.uP');
        return $formattedTimestamp;
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

    /**
     * Generate signature to get access token
     *
     * @param string $clientId client id
     * @param string $privateKey private key
     * @param string $timeStamp timestamp (date(c))
     * @return string signature access token, used as `X-Signature` header when getting access token
     */
    public function generateSignatureAccessToken(
        string $clientId,
        string $privateKey,
        string $timeStamp
    )
    {
        $formattedPrivateKey = "-----BEGIN RSA PRIVATE KEY-----\n"
            . wordwrap($privateKey, 64, "\n", true)
            . "\n-----END RSA PRIVATE KEY-----";
        $data = $clientId . '|' . $timeStamp;
        $binarySignature = "";

        openssl_sign($data, $binarySignature, $formattedPrivateKey, "SHA256");

        return base64_encode($binarySignature);
    }

    /**
     * Generate signature service
     *
     * @param string $method mostly `POST`
     * @param array $body request body
     * @param string $url request url (without base url)
     * @param string $accessToken access token
     * @param string $timeStamp timestamp (date(c))
     * @param string $clientSecret client secret
     * @return string signature service
     */
    public function generateSignatureService(
        string $method,
        array $body,
        string $url,
        string $accessToken,
        string $timeStamp,
        string $clientSecret
    )
    {
        $requestBody = json_encode($body);
        $hash = hash('sha256', $requestBody);

        $stringToSign = $method . ':' . $url . ':' . $accessToken . ':' . strtolower($hash) . ':' . $timeStamp;
        $hmac = hash_hmac('sha512', $stringToSign, $clientSecret, true);
        return base64_encode($hmac);
    }

    public function randomNumber()
    {
        return rand(10, 100000000) . time();
    }

    /**
     * Generate random alphanumeric
     *
     * @param integer $length length of random string
     * @return string random alphanumeric
     */
    public function randomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Format amount to 2 decimal places
     *
     * @param float $amount amount
     * @return string formatted amount
     */
    public function formatAmount($amount = 0.00)
    {
        return number_format($amount, 2, '.', '');
    }
}
