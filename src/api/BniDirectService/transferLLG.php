<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferLLG
{
    /**
     * LLG Transfer
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
     * @param string $beneficiaryAccountNo Beneficiary Account No (max 34 chars) - required
     * @param string $beneficiaryAccountName Beneficiary Account Name (max 70 chars) - required
     * @param string|null $beneficiaryAddress1 Beneficiary Address (1) (max 50 chars) - optional
     * @param string|null $beneficiaryAddress2 Beneficiary Address (2) (max 50 chars) - optional
     * @param string|null $beneficiaryAddress3 Beneficiary Address (3) (max 50 chars) - optional
     * @param string $beneficiaryResidentshipCountryCode Beneficiary Residentship Country Code (max 40 chars) - required
     * @param string $beneficiaryCitizenshipCountryCode Beneficiary Citizenship Country Code (max 40 chars) - required
     * @param string $beneficiaryType Beneficiary Type (max 2 chars) - required
     * @param string $beneficiaryBankCode Beneficiary Bank Code (max 40 chars) - required
     * @param string $beneficiaryBankName Beneficiary Bank Name (max 100 chars) - required
     * @param string|null $beneficiaryBankBranchCode Beneficiary Bank Branch Code (max 40 chars) - optional
     * @param string|null $beneficiaryBankBranchName Beneficiary Bank Branch Name (max 100 chars) - optional
     * @param string $beneficiaryBankCityName Beneficiary Bank City Name (max 100 chars) - required
     * @param string $notificationFlag Notification Flag (1 char) - required
     * @param string|null $beneficiaryEmail Beneficiary Email (max 100 chars) - optional
     * @param string $transactionInstructionDate Transaction Instruction Date (max 18 chars, yyyyMMdd format) - required
     * @return Object
     */

    public function transferLLG(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_LLG;
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
            'beneficiaryAccountName' => $params['beneficiaryAccountName'],
            'beneficiaryAddress1' => $params['beneficiaryAddress1'] ?? null,
            'beneficiaryAddress2' => $params['beneficiaryAddress2'] ?? null,
            'beneficiaryAddress3' => $params['beneficiaryAddress3'] ?? null,
            'beneficiaryResidentshipCountryCode' => $params['beneficiaryResidentshipCountryCode'],
            'beneficiaryCitizenshipCountryCode' => $params['beneficiaryCitizenshipCountryCode'],
            'beneficiaryType' => $params['beneficiaryType'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode'],
            'beneficiaryBankName' => $params['beneficiaryBankName'],
            'beneficiaryBankBranchCode' => $params['beneficiaryBankBranchCode'] ?? null,
            'beneficiaryBankBranchName' => $params['beneficiaryBankBranchName'] ?? null,
            'beneficiaryBankCityName' => $params['beneficiaryBankCityName'],
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'] ?? null,
            'transactionInstructionDate' => $params['transactionInstructionDate'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>