<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait domesticSingleBIFastTransfer
{
    public function domesticSingleBIFastTransfer(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $amountCurrency,
        string $amount,
        string $exchangeRateCode,
        string $treasuryReferenceNo,
        string $chargeTo,
        string $remark1,
        string $remark2,
        string $remark3,
        string $remitterReferenceNo,
        string $finalizePaymentFlag,
        string $beneficiaryReferenceNo,
        string $usedProxy,
        string $beneficiaryAccountNo,
        string $proxyId,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
        string $transactionPurposeCode
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_DOMESTIC_SINGLE_BI_FAST_TRANSFER . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'amountCurrency' => $amountCurrency,
            'amount' => $amount,
            'exchangeRateCode' => $exchangeRateCode,
            'treasuryReferenceNo' => $treasuryReferenceNo,
            'chargeTo' => $chargeTo,
            'remark1' => $remark1,
            'remark2' => $remark2,
            'remark3' => $remark3,
            'remitterReferenceNo' => $remitterReferenceNo,
            'finalizePaymentFlag' => $finalizePaymentFlag,
            'beneficiaryReferenceNo' => $beneficiaryReferenceNo,
            'usedProxy' => $usedProxy,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'proxyId' => $proxyId,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'notificationFlag' => $notificationFlag,
            'beneficiaryEmail' => $beneficiaryEmail,
            'transactionInstructionDate' => $transactionInstructionDate,
            'transactionPurposeCode' => $transactionPurposeCode
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>