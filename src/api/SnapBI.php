<?php

namespace Wawatprigala\BniPhp\api;

use Exception;
use Illuminate\Support\Facades\Http;
use Wawatprigala\BniPhp\Bni;
use Wawatprigala\BniPhp\net\HttpClient;
use Wawatprigala\BniPhp\utils\Response;
use Wawatprigala\BniPhp\utils\Util;

class SnapBI
{
    protected $bni;
    protected $privateKeyPath;
    protected $channelId;
    protected $ipAddress;
    protected $latitude;
    protected $longitude;

    function __construct(Bni $bni, string $privateKeyPath, string $channelId, string $ipAddress = '', string $latitude = '', string $longitude = '')
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
        $this->privateKeyPath = $privateKeyPath;
        $this->channelId = $channelId;
        $this->ipAddress = $ipAddress;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getToken()
    {
        $timeStamp = $this->utils->getTimeStamp();
        $response = Http::withHeaders([
            'X-SIGNATURE' => $this->utils->generateSignatureSnapBI(
                $this->bni->clientId,
                $this->privateKeyPath,
                $timeStamp
            ),
            'X-TIMESTAMP' => $timeStamp,
            'X-CLIENT-KEY' => $this->bni->clientId
        ])->post($this->bni->getBaseUrl() . "/snap/v1/access-token/b2b", [
            'grantType' => 'client_credentials',
            'additionalInfo' => (object) []
        ]);

        if ($response->failed()) {
            throw new Exception($response->object()->responseCode . ' : ' . $response->object()->responseMessage);

        }
        return $response->object()->accessToken;
    }

    public function balanceInquiry(string $partnerReferenceNo, string $accountNo)
    {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'accountNo' => $accountNo
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/balance-inquiry',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/balance-inquiry',
                    $token,
                    $timeStamp,
                    $this->bni->apiSecret
                ),
                'X-TIMESTAMP' => $timeStamp,
                'X-PARTNER-ID' => $this->bni->apiKey,
                'X-IP-Address' => $this->ipAddress,
                'X-DEVICE-ID' => 'bni-php/0.1.0',
                'X-EXTERNAL-ID' => $this->utils->randomNumber(),
                'CHANNEL-ID' => $this->channelId,
                'X-LATITUDE' => $this->latitude,
                'X-LONGITUDE' => $this->longitude
            ]
        );

        if ($response->failed()) {
            throw new Exception($response->object()->responseCode . ' : ' . $response->object()->responseMessage);

        }

        return $response->object();
    }

    public function bankStatement(string $partnerReferenceNo, string $accountNo, string $fromDateTime, string $toDateTime)
    {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'accountNo' => $accountNo,
            'fromDateTime' => $fromDateTime,
            'toDateTime' => $toDateTime
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/bank-statement',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/bank-statement',
                    $token,
                    $timeStamp,
                    $this->bni->apiSecret
                ),
                'X-TIMESTAMP' => $timeStamp,
                'X-PARTNER-ID' => $this->bni->apiKey,
                'X-IP-Address' => $this->ipAddress,
                'X-DEVICE-ID' => 'bni-php/0.1.0',
                'X-EXTERNAL-ID' => $this->utils->randomNumber(),
                'CHANNEL-ID' => $this->channelId,
                'X-LATITUDE' => $this->latitude,
                'X-LONGITUDE' => $this->longitude
            ]
        );

        return Response::snapBI($response);
    }
}
