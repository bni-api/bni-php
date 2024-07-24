<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferOnline
{
    /**
     * Online Transfer
     * @param string $corporateId Corporate ID (max 40 chars) - required
     * @param string $userId User ID (max 40 chars) - required
     * @param string $debitedAccountNo Debited Account No (max 16 chars) - required
     * @param string $amountCurrency Amount Currency (max 3 chars) - required
     * @param string $amount Amount (max 15 chars) - required
     * @param string|null $treasuryReferenceNo Treasury Reference No (max 40 chars) - optional
     * @param string $chargeTo Charge To (max 3 chars) - required
     * @param string|null $remark1 Remark 1 (max 40 chars) - optional
     * @param string|null $remark2 Remark 2 (max 40 chars) - optional
     * @param string|null $remark3 Remark 3 (max 40 chars) - optional
     * @param string $remitterReferenceNo Remitter Reference No (max 16 chars) - required
     * @param string $finalizePaymentFlag Finalize Payment Flag (1 char) - required
     * @param string|null $beneficiaryReferenceNo Beneficiary Reference No (max 16 chars) - optional
     * @param string $beneficiaryAccountNo Beneficiary Account No (max 17 chars) - required
     * @param string $beneficiaryBankCode Beneficiary Bank Code (max 40 chars) - required
     * @param string $beneficiaryBankName Beneficiary Bank Name (max 100 chars) - required
     * @param string $notificationFlag Notification Flag (1 char) - required
     * @param string|null $beneficiaryEmail Beneficiary Email (max 100 chars) - optional
     * @param string|null $transactionInstructionDate Transaction Instruction Date (max 8 chars, yyyyMMdd format) - optional
     * @return Object
     */

    public function transferOnline(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_ONLINE;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitedAccountNo' => $params['debitedAccountNo'],
            'amountCurrency' => $params['amountCurrency'],
            'amount' => $params['amount'],
            'treasuryReferenceNo' => $params['treasuryReferenceNo'] ?? null,
            'chargeTo' => $params['chargeTo'],
            'remark1' => $params['remark1'] ?? null,
            'remark2' => $params['remark2'] ?? null,
            'remark3' => $params['remark3'] ?? null,
            'remitterReferenceNo' => $params['remitterReferenceNo'],
            'finalizePaymentFlag' => $params['finalizePaymentFlag'],
            'beneficiaryReferenceNo' => $params['beneficiaryReferenceNo'] ?? null,
            'beneficiaryAccountNo' => $params['beneficiaryAccountNo'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode'],
            'beneficiaryBankName' => $params['beneficiaryBankName'],
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'] ?? null,
            'transactionInstructionDate' => $params['transactionInstructionDate'] ?? null
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>