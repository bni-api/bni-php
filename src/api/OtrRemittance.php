<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class OtrRemittance
{
    protected $bni;
    public $httpClient;
    public $utils;
    private $channelId;

    public function __construct(Bni $bni, string $channelId)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
        $this->channelId = $channelId;
    }

    private function requestOtrRemittance($url, $dataJson, $data)
    {
        $time = $this->utils->getTimeStampBniMove();
        $header = [
            'x-api-key' => $this->bni->apiKey,
            'x-signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'x-timestamp' => $time,
            'Requestid' => $this->utils->requestId(),
            'ChannelId' => $this->channelId
        ];
        return $this->httpClient->request("POST", $url, $header, $dataJson);
    }

    public function bankAndCurrencyLimitation(
        string $serviceType,
        string $country
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_OTR_REMITTANCE_BANK_AND_CURRENCY_LIMITATION;
        $data = [
            'serviceType' => $serviceType,
            'country' => $country
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];

        $response = $this->requestOtrRemittance($url, $dataJson, $data);

        return Response::OtrRemittance($response);
    }

    public function preTranscationRateInquiry(
        string $orderingId,
        string $bic,
        string $serviceType,
        string $sourceCcy,
        string $orderingCcy,
        string $detailCharges,
        float $orderingAmount,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_OTR_REMITTANCE_CHARGES_AND_RATE_INQUIRY;
        $data = [
            'orderingId' => $orderingId,
            'bic' => $bic,
            'serviceType' => $serviceType,
            'sourceCcy' => $sourceCcy,
            'orderingCcy' => $orderingCcy,            
            'detailCharges' => $detailCharges,
            'orderingAmount' => $orderingAmount
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestOtrRemittance($url, $dataJson, $data);

        return Response::OtrRemittance($response);
    }

    public function OtrStpNonStp(
        string $referenceNumber,
        string $orderingId,
        string $orderingBic,
        string $orderingName,
        string $orderingAddress,
        string $orderingEmail,
        string $orderingPhoneNumber,
        string $beneficiaryAccount,
        string $beneficiaryName,
        string $beneficiaryAddress,
        string $beneficiaryPhoneNumber,
        string $accountWithInstCode,
        string $accountWithInstBic,
        string $accountWithInstName,
        string $remittanceInfo,
        string $invoiceNumber,
        float $invoiceAmount,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_OTR_REMITTANCE_TRANSCATION_OVERBOOKING;
        $data = [
            'referenceNumber' => $referenceNumber,
            'orderingId' => $orderingId,
            'orderingBic' => $orderingBic,
            'orderingName' => $orderingName,
            'orderingAddress' => $orderingAddress,
            'orderingEmail' => $orderingEmail,
            'orderingPhoneNumber' => $orderingPhoneNumber,
            'beneficiaryAccount' => $beneficiaryAccount,
            'beneficiaryName' => $beneficiaryName,
            'beneficiaryAddress' => $beneficiaryAddress,
            'beneficiaryPhoneNumber' => $beneficiaryPhoneNumber,
            'accountWithInstCode' => $accountWithInstCode,
            'accountWithInstBic' => $accountWithInstBic,
            'accountWithInstName' => $accountWithInstName,
            'remittanceInfo' => $remittanceInfo,
            'invoiceNumber' => $invoiceNumber,
            'invoiceAmount' => $invoiceAmount
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestOtrRemittance($url, $dataJson, $data);

        return Response::OtrRemittance($response);
    }

    public function GPITracker(
        string $referenceNumber
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_OTR_REMITTANCE_TRACKING_TRANSCATION;
        $data = [
            'referenceNumber' => $referenceNumber
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestOtrRemittance($url, $dataJson, $data);

        return Response::OtrRemittance($response);
    }
}
