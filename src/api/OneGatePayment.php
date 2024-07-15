<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class OneGatePayment
{

    protected $bni;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    private function requestOgp($url, $data)
    {
        $header = [
            'X-API-Key' => $this->bni->apiKey,
        ];

        return $this->httpClient->request('POST', $url, $header, $data);
    }

    public function getBalance(string $accountNo)
    {
        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_GETBALANCE . '?access_token=' . $this->bni->getToken();
        $body = [
            'accountNo' => $accountNo,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'getBalanceResponse');
    }

    public function getInHouseInquiry(string $accountNo)
    {
        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_GETINHOUSEINQUIRY . '?access_token=' . $this->bni->getToken();

        $body = [
            'accountNo' => $accountNo,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'getInHouseInquiryResponse');
    }

    public function doPayment(
        string $customerReferenceNumber,
        string $paymentMethod,
        string $debitAccountNo,
        string $creditAccountNo,
        string $valueDate,
        string $valueCurrency,
        int $valueAmount,
        string $remark,
        string $beneficiaryEmailAddress,
        string $beneficiaryName,
        string $beneficiaryAddress1,
        string $beneficiaryAddress2,
        string $destinationBankCode,
        string $chargingModelId
    ) {

        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_DOYPAYMENT . '?access_token=' .  $this->bni->getToken();
        $body = [
            "clientId" => $this->utils->generateClientId($this->bni->appName),
            "customerReferenceNumber" => $customerReferenceNumber,
            "paymentMethod" => $paymentMethod,
            "debitAccountNo" => $debitAccountNo,
            "creditAccountNo" => $creditAccountNo,
            "valueDate" => $valueDate,
            "valueCurrency" => $valueCurrency,
            "valueAmount" => $valueAmount,
            "remark" => $remark,
            "beneficiaryEmailAddress" => $beneficiaryEmailAddress,
            "beneficiaryName" => $beneficiaryName,
            "beneficiaryAddress1" => $beneficiaryAddress1,
            "beneficiaryAddress2" => $beneficiaryAddress2,
            "destinationBankCode" => $destinationBankCode,
            "chargingModelId" => $chargingModelId
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'doPaymentResponse');
    }

    public function getPaymentStatus(string $customerReferenceNumber)
    {
        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_GETPAYMENTSTATUS . '?access_token=' . $this->bni->getToken();
        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'getPaymentStatusResponse');
    }

    public function getInterBankInquiry(
        string $customerReferenceNumber,
        string $accountNum,
        string $destinationBankCode,
        string $destinationAccountNum
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_GETINTERBANKINQUIRY . '?access_token=' . $this->bni->getToken();

        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'accountNum' => $accountNum,
            'destinationBankCode' => $destinationBankCode,
            'destinationAccountNum' => $destinationAccountNum,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'getInterbankInquiryResponse');
    }

    public function getInterBankPayment(
        string $customerReferenceNumber,
        int $amount,
        string $destinationAccountNum,
        string $destinationAccountName,
        string $destinationBankCode,
        string $destinationBankName,
        string $accountNum,
        string $retrievalReffNum
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_H2H_GETINTERBANKPAYMENT . '?access_token=' . $this->bni->getToken();

        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'amount' => $amount,
            'destinationAccountNum' => $destinationAccountNum,
            'destinationAccountName' => $destinationAccountName,
            'destinationBankCode' => $destinationBankCode,
            'destinationBankName' => $destinationBankName,
            'accountNum' => $accountNum,
            'retrievalReffNum' => $retrievalReffNum,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];

        $data = [
            RequestOptions::JSON => array_merge($body, $signature)
        ];

        $response = $this->requestOgp($url, $data);

        return Response::oneGatePayment($response, 'getInterbankPaymentResponse');
    }

    // public function holdAmount(
    //     string $customerReferenceNumber,
    //     int $amount,
    //     string $accountNo,
    //     string $detail
    // ) {
    //     $url = $this->bni->getBaseUrl() . Constant::URL_H2H_HOLDAMOUNT . '?access_token=' . $this->bni->getToken();

    //     $body = [
    //         'customerReferenceNumber' => $customerReferenceNumber,
    //         'amount' => $amount,
    //         'accountNo' => $accountNo,
    //         'detail' => $detail,
    //         'clientId' => $this->utils->generateClientId($this->bni->appName)
    //     ];

    //     $signature = [
    //         'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
    //     ];

    //     $data = [
    //         RequestOptions::JSON => array_merge($body, $signature)
    //     ];

    //     $response = $this->requestOgp($url, $data);

    //     return Response::oneGatePayment($response, 'holdAmountResponse');
    // }

    // public function holdAmountRelease(
    //     string $customerReferenceNumber,
    //     int $amount,
    //     string $accountNo,
    //     string $bankReference,
    //     string $holdTransactionDate
    // ) {
    //     $url = $this->bni->getBaseUrl() . Constant::URL_H2H_HOLDAMOUNTRELEASE . '?access_token=' . $this->bni->getToken();

    //     $body = [
    //         'customerReferenceNumber' => $customerReferenceNumber,
    //         'amount' => $amount,
    //         'accountNo' => $accountNo,
    //         'bankReference' => $bankReference,
    //         'holdTransactionDate' => $holdTransactionDate,
    //         'clientId' => $this->utils->generateClientId($this->bni->appName)
    //     ];

    //     $signature = [
    //         'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
    //     ];

    //     $data = [
    //         RequestOptions::JSON => array_merge($body, $signature)
    //     ];

    //     $response = $this->requestOgp($url, $data);

    //     return Response::oneGatePayment($response, 'holdAmountReleaseResponse');
    // }
}
