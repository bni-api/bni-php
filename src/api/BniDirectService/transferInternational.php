<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait transferInternational
{
    public function transferInternational(
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
        string $organizationDirectoryCode,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        string $beneficiaryBankBranchName,
        string $beneficiaryBankAddress1,
        string $beneficiaryBankAddress2,
        string $beneficiaryBankAddress3,
        string $beneficiaryBankCountryName,
        string $correspondentBankName,
        string $identicalStatusFlag,
        string $beneficiaryResidentshipCode,
        string $beneficiaryCitizenshipCode,
        string $beneficiaryCategoryCode,
        string $transactorRelationship,
        string $transactionPurposeCode,
        string $transactionDescription,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
        string $docUniqueId,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_TRANSFER_INTERNATIONAL . '?access_token=' . $this->bni->getToken();
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
            'beneficiaryAddress2' => $beneficiaryAddress2,
            'beneficiaryAddress3' => $beneficiaryAddress3,
            'organizationDirectoryCode' => $organizationDirectoryCode,
            'beneficiaryBankCode' => $beneficiaryBankCode,
            'beneficiaryBankName' => $beneficiaryBankName,
            'beneficiaryBankBranchName' => $beneficiaryBankBranchName,
            'beneficiaryBankAddress1' => $beneficiaryBankAddress1,
            'beneficiaryBankAddress2' => $beneficiaryBankAddress2,
            'beneficiaryBankAddress3' => $beneficiaryBankAddress3,
            'beneficiaryBankCountryName' => $beneficiaryBankCountryName,
            'correspondentBankName' => $correspondentBankName,
            'identicalStatusFlag' => $identicalStatusFlag,
            'beneficiaryResidentshipCode' => $beneficiaryResidentshipCode,
            'beneficiaryCitizenshipCode' => $beneficiaryCitizenshipCode,
            'beneficiaryCategoryCode' => $beneficiaryCategoryCode,
            'transactorRelationship' => $transactorRelationship,
            'transactionPurposeCode' => $transactionPurposeCode,
            'transactionDescription' => $transactionDescription,
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