<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferRTGS
{
    public function transferRTGS(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $amountCurrency,
        string $amount,
        string $treasuryReferenceNo,
        string $chargeTo,
        string $remark1,
        string $remark2,
        string $remark3,
        string $remitterReferenceNo,
        string $finalizePaymentFlag,
        string $beneficiaryReferenceNo,
        string $beneficiaryAccountNo,
        string $beneficiaryAccountName,
        string $beneficiaryAddress1,
        string $beneficiaryAddress2,
        string $beneficiaryAddress3,
        string $beneficiaryResidentshipCountryCode,
        string $beneficiaryCitizenshipCountryCode,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $beneficiaryBankBranchCode,
        string $beneficiaryBankBranchName,
        string $beneficiaryBankCityName,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_RTGS . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'amountCurrency' => $amountCurrency,
            'amount' => $amount,
            'treasuryReferenceNo' => $treasuryReferenceNo,
            'chargeTo' => $chargeTo,
            'remark1' => $remark1,
            'remark2' => $remark2,
            'remark3' => $remark3,
            'remitterReferenceNo' => $remitterReferenceNo,
            'finalizePaymentFlag' => $finalizePaymentFlag,
            'beneficiaryReferenceNo' => $beneficiaryReferenceNo,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryAccountName' => $beneficiaryAccountName,
            'beneficiaryAddress1' => $beneficiaryAddress1,
            'beneficiaryAddress2' => $beneficiaryAddress1,
            'beneficiaryAddress3' => $beneficiaryAddress1,
            'beneficiaryResidentshipCountryCode' => $beneficiaryResidentshipCountryCode,
            'beneficiaryCitizenshipCountryCode' => $beneficiaryCitizenshipCountryCode,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'beneficiaryBankBranchCode' => $beneficiaryBankBranchCode,
            'beneficiaryBankBranchName' => $beneficiaryBankBranchName,
            'beneficiaryBankCityName' => $beneficiaryBankCityName,
            'notificationFlag' => $notificationFlag,
            'beneficiaryEmail' => $beneficiaryEmail,
            'transactionInstructionDate' => $transactionInstructionDate,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>