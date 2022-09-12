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

    public function balanceInquiry(
        string $partnerReferenceNo,
        string $accountNo
    ) {
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

        return Response::snapBI($response);
    }

    public function bankStatement(
        string $partnerReferenceNo,
        string $accountNo,
        string $fromDateTime,
        string $toDateTime
    ) {
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

    public function internalAccountInquiry(
        string $partnerReferenceNo,
        string $beneficiaryAccountNo
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'beneficiaryAccountNo' => $beneficiaryAccountNo
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/account-inquiry-internal',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/account-inquiry-internal',
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

    public function transactionStatusInquiry(
        string $originalPartnerReferenceNo,
        string $originalReferenceNo,
        string $originalExternalId,
        string $serviceCode,
        string $transactionDate,
        string $amountValue,
        string $amountCurrency,
        string $addtionalInfoDeviceId,
        string $additionalInfoChannel
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
            'originalreferenceNo' => $originalReferenceNo,
            'originalExternalId' => $originalExternalId,
            'serviceCode' => $serviceCode,
            'transactionDate' => $transactionDate,
            'amount' => [
                'value' => $amountValue,
                'currency' => $amountCurrency
            ],
            'additionalInfo' => [
                'deviceId' => $addtionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];

        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/transfer/status',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/transfer/status',
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

    public function transferIntrabank(
        string $partnerReferenceNo,
        string $amountValue,
        string $amountCurrency,
        string $beneficiaryAccountNo,
        string $beneficiaryEmail,
        string $currency,
        string $customerReference,
        string $feeType,
        string $remark,
        string $sourceAccountNo,
        string $transactionDate,
        string $additionalInfoDeviceId,
        string $additionalInfoChannel
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountValue,
                'currency' => $amountCurrency
            ],
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryEmail' => $beneficiaryEmail,
            'currency' => $currency,
            'customerReference' => $customerReference,
            'feeType' => $feeType,
            'remark' => $remark,
            'sourceAccountNo' => $sourceAccountNo,
            'transactionDate' => $transactionDate,
            'addtionalInfo' => [
                'deviceId' => $additionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];

        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/transfer-intrabank',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/transfer-intrabank',
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

    public function transferRTGS(
        string $partnerReferenceNo,
        string $amountvalue,
        string $amountcurrency,
        string $beneficiaryAccountName,
        string $beneficiaryAccountNo,
        string $beneficiaryAccountAddress,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $beneficiaryCustomerResidence,
        string $beneficiaryCustomerType,
        string $beneficiaryEmail,
        string $currency,
        string $customerReference,
        string $feeType,
        string $kodepos,
        string $recieverPhone,
        string $remark,
        string $senderCustomerResidence,
        string $senderCustomerType,
        string $senderPhone,
        string $sourceAccountNo,
        string $transactionDate,
        string $additionalInfochanel,
        string $additionalInfodeviceid
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountvalue,
                'currency' => $amountcurrency
            ],
            'beneficiaryAccountName' => $beneficiaryAccountName,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryAccountAddress' => $beneficiaryAccountAddress,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'beneficiaryCustomerResidence' => $beneficiaryCustomerResidence,
            'beneficiaryCustomerType' => $beneficiaryCustomerType,
            'beneficiaryEmail' => $beneficiaryEmail,
            'currency' => $currency,
            'customerReference' => $customerReference,
            'feeType' => $feeType,
            'kodepos' => $kodepos,
            'recieverPhone' => $recieverPhone,
            'remark' => $remark,
            'senderCustomerResidence' => $senderCustomerResidence,
            'senderCustomerType' => $senderCustomerType,
            'senderPhone' => $senderPhone,
            'sourceAccountNo' => $sourceAccountNo,
            'transactionDate' => $transactionDate,
            'additionalInfo' => [
                'deviceid' => $additionalInfodeviceid,
                'chanel' => $additionalInfochanel
            ]
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/transfer-rtgs',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/transfer-rtgs',
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

    public function transferSKNBI(
        string $partnerReferenceNo,
        string $amountvalue,
        string $amountcurrency,
        string $beneficiaryAccountName,
        string $beneficiaryAccountNo,
        string $beneficiaryAccountAddress,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $beneficiaryCustomerResidence,
        string $beneficiaryCustomerType,
        string $beneficiaryEmail,
        string $currency,
        string $customerReference,
        string $feeType,
        string $kodepos,
        string $recieverPhone,
        string $remark,
        string $senderCustomerResidence,
        string $senderCustomerType,
        string $senderPhone,
        string $sourceAccountNo,
        string $transactionDate,
        string $additionalInfochanel,
        string $additionalInfodeviceid
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountvalue,
                'currency' => $amountcurrency
            ],
            'beneficiaryAccountName' => $beneficiaryAccountName,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryAccountAddress' => $beneficiaryAccountAddress,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'beneficiaryCustomerResidence' => $beneficiaryCustomerResidence,
            'beneficiaryCustomerType' => $beneficiaryCustomerType,
            'beneficiaryEmail' => $beneficiaryEmail,
            'currency' => $currency,
            'customerReference' => $customerReference,
            'feeType' => $feeType,
            'kodepos' => $kodepos,
            'recieverPhone' => $recieverPhone,
            'remark' => $remark,
            'senderCustomerResidence' => $senderCustomerResidence,
            'senderCustomerType' => $senderCustomerType,
            'senderPhone' => $senderPhone,
            'sourceAccountNo' => $sourceAccountNo,
            'transactionDate' => $transactionDate,
            'additionalInfo' => [
                'deviceid' => $additionalInfodeviceid,
                'chanel' => $additionalInfochanel
            ]
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/transfer-skn',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/transfer-skn',
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

    public function externalAccountInquiry(
        string $beneficiaryBankCode,
        string $beneficiaryAccountNo,
        string $partnerReferenceNo,
        string $additionalInfodeviceid,
        string $additionalInfochanel

    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'additionalInfo' => [
                'deviceId' => $additionalInfodeviceid,
                'channel' => $additionalInfochanel
            ]
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/account-inquiry-external',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/account-inquiry-external',
                    $token,
                    $timeStamp,
                    $this->bni->apiSecret
                ),
                'X-TIMESTAMP'   => $timeStamp,
                'X-PARTNER-ID'  => $this->bni->apiKey,
                'X-IP-Address'  => $this->ipAddress,
                'X-DEVICE-ID'   => 'bni-php/0.1.0',
                'X-EXTERNAL-ID' => $this->utils->randomNumber(),
                'CHANNEL-ID'    => $this->channelId,
                'X-LATITUDE'    => $this->latitude,
                'X-LONGITUDE'   => $this->longitude
            ]
        );

        return Response::snapBI($response);
    }

    public function transferInterbank(
        string $partnerReferenceNo,
        string $amountvalue,
        string $amountcurrency,
        string $beneficiaryAccountName,
        string $beneficiaryAccountNo,
        string $beneficiaryAccountAddress,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $beneficiaryEmail,
        string $currency,
        string $customerReference,
        string $sourceAccountNo,
        string $transactionDate,
        string $feeType,
        string $additionalInfochanel,
        string $additionalInfodeviceid
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountvalue,
                'currency' => $amountcurrency
            ],
            'beneficiaryAccountName' => $beneficiaryAccountName,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryAccountAddress' => $beneficiaryAccountAddress,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'beneficiaryemail' => $beneficiaryEmail,
            'currency' => $currency,
            'customerReference' => $customerReference,
            'sourceAccountNo' => $sourceAccountNo,
            'transactionDate' => $transactionDate,
            'feeType' => $feeType,
            'additionalInfo' => [
                'deviceId' => $additionalInfodeviceid,
                'channel' => $additionalInfochanel
            ]
        ];
        $token = $this->getToken();
        $response = $this->httpClient->requestSnapBI(
            $token,
            $this->bni->getBaseUrl() . '/snap-service/v1/transfer-interbank',
            $body,
            [
                'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI(
                    'POST',
                    $body,
                    '/snap-service/v1/transfer-interbank',
                    $token,
                    $timeStamp,
                    $this->bni->apiSecret
                ),
                'X-TIMESTAMP'   => $timeStamp,
                'X-PARTNER-ID'  => $this->bni->apiKey,
                'X-IP-Address'  => $this->ipAddress,
                'X-DEVICE-ID'   => 'bni-php/0.1.0',
                'X-EXTERNAL-ID' => $this->utils->randomNumber(),
                'CHANNEL-ID'    => $this->channelId,
                'X-LATITUDE'    => $this->latitude,
                'X-LONGITUDE'   => $this->longitude
            ]
        );

        return Response::snapBI($response);
    }
}
