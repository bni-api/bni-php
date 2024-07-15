<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inhouseTransfer
{
    public function inhouseTransfer(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $amountCurrency,
        string $amount,
        string $treasuryReferenceNo,
        string $transactionPurposeCode,
        string $remark1,
        string $remark2,
        string $remark3,
        string $remitterReferenceNo,
        string $finalizePaymentFlag,
        string $beneficiaryReferenceNo,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
        string $docUniqueId
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INHOUSE_TRANSFER . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'amountCurrency' => $amountCurrency,
            'amount' => $amount,
            'treasuryReferenceNo' => $treasuryReferenceNo,
            'transactionPurposeCode' => $transactionPurposeCode,
            'remark1' => $remark1,
            'remark2' => $remark2,
            'remark3' => $remark3,
            'remitterReferenceNo' => $remitterReferenceNo,
            'finalizePaymentFlag' => $finalizePaymentFlag,
            'beneficiaryReferenceNo' => $beneficiaryReferenceNo,
            'notificationFlag' => $notificationFlag,
            'beneficiaryEmail' => $beneficiaryEmail,
            'transactionInstructionDate' => $transactionInstructionDate,
            'docUniqueId' => $docUniqueId,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>