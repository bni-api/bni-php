<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class SnapBI
{
    public $bni;
    public $privateKeyPath;
    public $channelId;
    public $ipAddress;
    public $latitude;
    public $longitude;

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

    public function requestSnapBI(string $url, string $token, array $data, string $timeStamp)
    {
        $header = [
            'Authorization' => 'Bearer ' . $token,
            'X-SIGNATURE' => $this->utils->generateSignatureServiceSnapBI('POST', $data, $url, $token, $timeStamp, $this->bni->apiSecret),
            'X-TIMESTAMP' => $timeStamp,
            'X-PARTNER-ID' => $this->bni->apiKey,
            'X-IP-Address' => $this->ipAddress,
            'X-DEVICE-ID' => 'bni-php/0.1.0',
            'X-EXTERNAL-ID' => $this->utils->randomNumber(),
            'CHANNEL-ID' => $this->channelId,
            'X-LATITUDE' => $this->latitude,
            'X-LONGITUDE' => $this->longitude
        ];

        $url = $this->bni->getBaseUrl() . $url;

        $body = [
            RequestOptions::JSON => $data
        ];

        return $this->httpClient->request('POST', $url, $header, $body);
    }

    public function getToken()
    {
        $timeStamp = $this->utils->getTimeStamp();

        $url = $this->bni->getBaseUrl() . Constant::URL_SNAP_GETTOKEN;

        $signature = $this->utils->generateSignatureSnapBI(
            $this->bni->clientId,
            $this->privateKeyPath,
            $timeStamp
        );

        $header = [
            'X-SIGNATURE' => $signature,
            'X-TIMESTAMP' => $timeStamp,
            'X-CLIENT-KEY' => $this->bni->clientId
        ];

        $data = [
            RequestOptions::JSON => [
                'grantType' => 'client_credentials',
                'additionalInfo' => (object) []
            ]
        ];
        $response = $this->httpClient->request('POST', $url, $header, $data);
        return json_decode($response->getBody())->accessToken;
    }

    public function balanceInquiry(
        string $partnerReferenceNo,
        string $accountNo
    ) {
        $timeStamp = $this->utils->getTimeStamp();

        $token = $this->getToken();

        $url = Constant::URL_SNAP_BALANCEINQUIRY;

        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'accountNo' => $accountNo
        ];

        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function internalAccountInquiry(
        string $partnerReferenceNo,
        string $beneficiaryAccountNo,
        // string $beneficiaryAccountNo = "false"
    ) {
        $timeStamp = $this->utils->getTimeStamp();
        
        $token = $this->getToken();

        $url = Constant::URL_SNAP_INTERNALACCOUNTINQUIRY;
        // if($beneficiaryAccountNo == "false"){
        //     $body = [
        //         'partnerReferenceNo' => $partnerReferenceNo,
        //     ];
        // } else {
        //     $body = [
        //         'partnerReferenceNo' => $partnerReferenceNo,
        //         'beneficiaryAccountNo' => $beneficiaryAccountNo
        //     ];
        // }
        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'beneficiaryAccountNo' => $beneficiaryAccountNo
        ];

        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

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
        
        $token = $this->getToken();

        $url = Constant::URL_SNAP_TRANSACTIONSTATUSINQUIRY;

        $body = [
            'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
            'originalReferenceNo' => $originalReferenceNo,
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

        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function transferIntraBank(
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

        $token = $this->getToken();

        $url = Constant::URL_SNAP_TRANSFERINTRABANK;

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

        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function transferRTGS(
        string $partnerReferenceNo,
        string $amountValue,
        string $amountCurrency,
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
        string $additionalInfoDeviceId,
        string $additionalInfoChannel
    ) {
        $timeStamp = $this->utils->getTimeStamp();

        $token = $this->getToken();

        $url = Constant::URL_SNAP_TRANSFERRTGS;

        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountValue,
                'currency' => $amountCurrency
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
                'deviceId' => $additionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];
       
        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function transferSKNBI(
        string $partnerReferenceNo,
        string $amountValue,
        string $amountCurrency,
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
        string $additionalInfoDeviceId,
        string $additionalInfoChannel
    ) {
        $timeStamp = $this->utils->getTimeStamp();

        $token = $this->getToken();

        $url = Constant::URL_SNAP_TRANSFERSKNBI;

        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountValue,
                'currency' => $amountCurrency
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
                'deviceId' => $additionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];
       
        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function externalAccountInquiry(
        string $beneficiaryAccountNo,
        string $partnerReferenceNo,
        string $beneficiaryBankCode,
        string $additionalInfoDeviceId,
        string $additionalInfoChannel

    ) {
        $timeStamp = $this->utils->getTimeStamp();

        $token = $this->getToken();

        $url = Constant::URL_SNAP_EXTERNALACCOUNTINQUIRY;

        $body = [
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'partnerReferenceNo' => $partnerReferenceNo,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'additionalInfo' => [
                'deviceId' => $additionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];
        
        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);

        return Response::snapBI($response);
    }

    public function transferInterBank(
        string $partnerReferenceNo,
        string $amountValue,
        string $amountCurrency,
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
        string $additionalInfoDeviceId,
        string $additionalInfoChannel
    ) {
        $timeStamp = $this->utils->getTimeStamp();

        $token = $this->getToken();

        $url = Constant::URL_SNAP_TRANSFERINTERBANK;

        $body = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'amount' => [
                'value' => $amountValue,
                'currency' => $amountCurrency
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
                'deviceId' => $additionalInfoDeviceId,
                'channel' => $additionalInfoChannel
            ]
        ];

        $response = $this->requestSnapBI($url, $token, $body, $timeStamp);
        
        return Response::snapBI($response);
    }
}