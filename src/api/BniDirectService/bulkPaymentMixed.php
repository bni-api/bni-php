<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bulkPaymentMixed
{
    public function bulkPaymentMixed(
        string $corporateId,
        string $userId,
        string $apiRefNo,
        string $instructionDate,
        string $session,
        string $serviceType,
        string $debitAcctNo,
        string $amount,
        string $currency,
        string $chargeTo,
        string $residenceCode,
        string $citizenCode,
        string $category,
        string $transactionType,
        string $accountNmValidation,
        string $remark,
        string $childContent
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BULK_PAYMENT_MIXED . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'apiRefNo' => $apiRefNo,
            'instructionDate' => $instructionDate,
            'session' => $session,
            'serviceType' => $serviceType,
            'debitAcctNo' => $debitAcctNo,
            'amount' => $amount,
            'currency' => $currency,
            'chargeTo' => $chargeTo,
            'residenceCode' => $residenceCode,
            'citizenCode' => $citizenCode,
            'category' => $category,
            'transactionType' => $transactionType,
            'accountNmValidation' => $accountNmValidation,
            'remark' => $remark,
            'childContent' => $childContent,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>