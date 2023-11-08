<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait createMPNG2BillingService
{
    public function createMPNG2Billing(
        string $corporateId,
        string $userId,
        string $npwp,
        string $taxPayerName,
        string $taxPayerAddress1,
        string $taxPayerAddress2,
        string $taxPayerAddress3,
        string $taxPayerCity,
        string $NOP,
        string $mapCode,
        string $depositTypeCode,
        string $wajibPungutNPWP,
        string $wajibPungutName,
        string $wajibPungutAddress1,
        string $wajibPungutAddress2,
        string $wajibPungutAddress3,
        string $participantId,
        string $assesmentTaxNumber,
        string $amountCurrency,
        string $amount,
        string $monthFrom,
        string $monthTo,
        string $year
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_CREATE_MPN_G2_BILLING_ID . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'npwp' => $npwp,
            'taxPayerName' => $taxPayerName,
            'taxPayerAddress1' => $taxPayerAddress1,
            'taxPayerAddress2' => $taxPayerAddress2,
            'taxPayerAddress3' => $taxPayerAddress3,
            'taxPayerCity' => $taxPayerCity,
            'NOP' => $NOP,
            'mapCode' => $mapCode,
            'depositTypeCode' => $depositTypeCode,
            'wajibPungutNPWP' => $wajibPungutNPWP,
            'wajibPungutName' => $wajibPungutName,
            'wajibPungutAddress1' => $wajibPungutAddress1,
            'wajibPungutAddress2' => $wajibPungutAddress2,
            'wajibPungutAddress3' => $wajibPungutAddress3,
            'participantId' => $participantId,
            'assesmentTaxNumber' => $assesmentTaxNumber,
            'amountCurrency' => $amountCurrency,
            'amount' => $amount,
            'monthFrom' => $monthFrom,
            'monthTo' => $monthTo,
            'year' => $year
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>