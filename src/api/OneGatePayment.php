<?php

namespace Wawatprigala\BniPhp\api;

use Wawatprigala\BniPhp\Bni;
use Wawatprigala\BniPhp\net\HttpClient;
use Wawatprigala\BniPhp\utils\Response;
use Wawatprigala\BniPhp\utils\Util;

class OneGatePayment
{

    protected $bni;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    public function getBalance(string $accountNo)
    {
        $body = [
            'accountNo' => $accountNo,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/getbalance',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'getBalanceResponse');
    }

    public function getInHouseInquiry(string $accountNo)
    {
        $body = [
            'accountNo' => $accountNo,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/getinhouseinquiry',
            array_merge($body, $signature)
        );

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
    )
    {

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
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/dopayment',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'doPaymentResponse');
    }

    public function getPaymentStatus(string $customerReferenceNumber)
    {
        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/getpaymentstatus',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'getPaymentStatusResponse');
    }

    public function getInterBankInquiry(
        string $customerReferenceNumber,
        string $accountNum,
        string $destinationBankCode,
        string $destinationAccountNum
    )
    {
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
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/getinterbankinquiry',
            array_merge($body, $signature)
        );

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
    )
    {
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
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/getinterbankpayment',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'getInterbankPaymentResponse');
    }

    public function holdAmount(
        string $customerReferenceNumber,
        int $amount,
        string $accountNo,
        string $detail
    )
    {
        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'amount' => $amount,
            'accountNo' => $accountNo,
            'detail' => $detail,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/holdamount',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'holdAmountResponse');
    }

    public function holdAmountRelease(
        string $customerReferenceNumber,
        int $amount,
        string $accountNo,
        string $bankReference,
        string $holdTransactionDate
    )
    {
        $body = [
            'customerReferenceNumber' => $customerReferenceNumber,
            'amount' => $amount,
            'accountNo' => $accountNo,
            'bankReference' => $bankReference,
            'holdTransactionDate' => $holdTransactionDate,
            'clientId' => $this->utils->generateClientId($this->bni->appName)
        ];

        $signature = [
            'signature' => $this->utils->generateSignature($body, $this->bni->apiSecret)
        ];
        $response = $this->httpClient->request(
            $this->bni->apiKey,
            $this->bni->getToken(),
            $this->bni->getBaseUrl() . '/H2H/v2/holdamountrelease',
            array_merge($body, $signature)
        );

        return Response::oneGatePayment($response, 'holdAmountReleaseResponse');
    }

}
