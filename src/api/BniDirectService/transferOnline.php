<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferOnline
{
    public function transferOnline(
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
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_ONLINE . '?access_token=' . $this->bni->getToken();
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
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
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