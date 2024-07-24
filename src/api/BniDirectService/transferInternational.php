<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferInternational
{
    /**
     * International Transfer
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
     * @param string $beneficiaryAccountName Beneficiary Account Name (max 80 chars) - required
     * @param string|null $beneficiaryAddress1 Beneficiary Address (1) (max 50 chars) - optional
     * @param string|null $beneficiaryAddress2 Beneficiary Address (2) (max 50 chars) - optional
     * @param string|null $beneficiaryAddress3 Beneficiary Address (3) (max 50 chars) - optional
     * @param string $organizationDirectoryCode Organization Directory Code (max 40 chars) - required
     * @param string $beneficiaryBankCode Beneficiary Bank Code (max 40 chars) - required
     * @param string $beneficiaryBankName Beneficiary Bank Name (max 100 chars) - required
     * @param string|null $beneficiaryBankBranchName Beneficiary Bank Branch Name (max 100 chars) - optional
     * @param string|null $beneficiaryBankAddress1 Beneficiary Bank Address (1) (max 35 chars) - optional
     * @param string|null $beneficiaryBankAddress2 Beneficiary Bank Address (2) (max 35 chars) - optional
     * @param string|null $beneficiaryBankAddress3 Beneficiary Bank Address (3) (max 35 chars) - optional
     * @param string|null $beneficiaryBankCountryName Beneficiary Bank Country Name (max 100 chars) - optional
     * @param string|null $correspondentBankName Correspondent Bank Name (max 100 chars) - optional
     * @param string $identicalStatusFlag Identical Status Flag (1 char) - required
     * @param string $beneficiaryResidentshipCode Beneficiary Residentship Code (max 40 chars) - required
     * @param string $beneficiaryCitizenshipCode Beneficiary Citizenship Code (max 40 chars) - required
     * @param string|null $beneficiaryCategoryCode Beneficiary Category Code (max 40 chars) - optional
     * @param string $transactorRelationship Transactor Relationship (Affiliated) Flag (1 char) - required
     * @param string $transactionPurposeCode Transaction Purpose Code (max 40 chars) - required
     * @param string|null $transactionDescription Transaction Description (max 100 chars) - optional
     * @param string $notificationFlag Notification Flag (1 char) - required
     * @param string|null $beneficiaryEmail Beneficiary Email (max 100 chars) - optional
     * @param string $transactionInstructionDate Transaction Instruction Date (yyyyMMdd format) - required
     * @param string $docUniqueId Unique underlying ID (max 40 chars) - required if transaction exceeds PIB 18 or WIC limits
     * @return Object
     */

    public function transferInternational(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_INTERNATIONAL;
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
            'organizationDirectoryCode' => $params['organizationDirectoryCode'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode'],
            'beneficiaryBankName' => $params['beneficiaryBankName'],
            'beneficiaryBankBranchName' => $params['beneficiaryBankBranchName'] ?? null,
            'beneficiaryBankAddress1' => $params['beneficiaryBankAddress1'] ?? null,
            'beneficiaryBankAddress2' => $params['beneficiaryBankAddress2'] ?? null,
            'beneficiaryBankAddress3' => $params['beneficiaryBankAddress3'] ?? null,
            'beneficiaryBankCountryName' => $params['beneficiaryBankCountryName'] ?? null,
            'correspondentBankName' => $params['correspondentBankName'] ?? null,
            'identicalStatusFlag' => $params['identicalStatusFlag'],
            'beneficiaryResidentshipCode' => $params['beneficiaryResidentshipCode'],
            'beneficiaryCitizenshipCode' => $params['beneficiaryCitizenshipCode'],
            'beneficiaryCategoryCode' => $params['beneficiaryCategoryCode'] ?? null,
            'transactorRelationship' => $params['transactorRelationship'],
            'transactionPurposeCode' => $params['transactionPurposeCode'],
            'transactionDescription' => $params['transactionDescription'] ?? null,
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'] ?? null,
            'transactionInstructionDate' => $params['transactionInstructionDate'],
            'docUniqueId' => $params['docUniqueId'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>