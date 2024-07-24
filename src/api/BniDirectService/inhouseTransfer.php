<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inhouseTransfer
{
    /**
     * Inhouse Transfer
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string|null $debitedAccountNo Debited Account No. (max 16 chars) - optional
     * @param string $amountCurrency Amount Currency (max 3 chars)
     * @param string $amount Amount (max 15 chars)
     * @param string|null $treasuryReferenceNo Treasury Reference No. (max 40 chars) - optional
     * @param string $transactionPurposeCode Transaction Purpose Code (max 40 chars)
     * @param string|null $remark1 Remark 1 (max 40 chars) - optional
     * @param string|null $remark2 Remark 2 (max 40 chars) - optional
     * @param string|null $remark3 Remark 3 (max 40 chars) - optional
     * @param string $remitterReferenceNo Remitter Reference No. (max 16 chars)
     * @param string $finalizePaymentFlag Finalize Payment Flag (max 1 char)
     * @param string|null $beneficiaryReferenceNo Beneficiary Reference No. (max 16 chars) - optional
     * @param string $toAccountNo To Account No. (max 16 chars)
     * @param string $notificationFlag Notification Flag (max 1 char)
     * @param string|null $beneficiaryEmail Beneficiary Email (max 100 chars) - optional
     * @param string $transactionInstructionDate Transaction Instruction Date (max 8 chars)
     * @param string|null $docUniqueId Unique ID (max 40 chars) - optional
     * @return Object
     */

    public function inhouseTransfer(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INHOUSE_TRANSFER;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitedAccountNo' => $params['debitedAccountNo'] ?? null,
            'amountCurrency' => $params['amountCurrency'],
            'amount' => $params['amount'],
            'treasuryReferenceNo' => $params['treasuryReferenceNo'] ?? null,
            'transactionPurposeCode' => $params['transactionPurposeCode'],
            'remark1' => $params['remark1'] ?? null,
            'remark2' => $params['remark2'] ?? null,
            'remark3' => $params['remark3'] ?? null,
            'remitterReferenceNo' => $params['remitterReferenceNo'],
            'finalizePaymentFlag' => $params['finalizePaymentFlag'],
            'beneficiaryReferenceNo' => $params['beneficiaryReferenceNo'] ?? null,
            'toAccountNo' => $params['toAccountNo'],
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'] ?? null,
            'transactionInstructionDate' => $params['transactionInstructionDate'],
            'docUniqueId' => $params['docUniqueId'] ?? null,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>