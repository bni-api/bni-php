<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait domesticSingleBIFastTransfer
{
    /**
     * Domestic Single BI Fast Transfer
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $debitedAccountNo Registered account number on the “Account Group” menu associated with the User Group of the Maker User ID. Must have the flag Allow Debit = Y (max 16 chars)
     * @param string $amountCurrency Currency code inputted must be “IDR” (max 3 chars)
     * @param string $amount Transaction amount. Decimals not allowed if transaction uses the currency matrix “local to local” (max 15 chars)
     * @param string $exchangeRateCode Exchange rate type. “Cr”: Counter rate, “Sr”: Special rate (max 2 chars)
     * @param string|null $treasuryReferenceNo Special rate ticket number. If inputted, the transaction will be assumed to be using “special rate” (max 40 chars) - optional
     * @param string $chargeTo “OUR”: Remitter, “BEN”: Beneficiary (max 3 chars)
     * @param string|null $remark1 Remark (max 40 chars) - optional
     * @param string|null $remark2 Remark (max 40 chars) - optional
     * @param string|null $remark3 Remark (max 40 chars) - optional
     * @param string|null $remitterReferenceNo Remitter’s reference number (max 16 chars) - optional
     * @param string $finalizePaymentFlag Can only be filled with “Y” or “N” (max 1 char)
     * @param string|null $beneficiaryReferenceNo Beneficiary’s reference number (max 16 chars) - optional
     * @param string $usedProxy “Y”: Proxy ID, “N”: Account no. (max 1 char)
     * @param string|null $beneficiaryAccountNo Account no. for beneficiary info. Only if account no. (“N”) is picked (max 16 chars) - conditional
     * @param string|null $proxyId E-mail or phone no. for beneficiary info. Only if proxy ID (“Y”) is picked (max 100 chars) - conditional
     * @param string $beneficiaryBankCode Data must match BIC/RTGS Code or BIFAST Bank Code (max 40 chars)
     * @param string $beneficiaryBankName Name of the beneficiary bank (max 100 chars)
     * @param string $notificationFlag “Y”: Send, “N”: Don’t send (max 1 char)
     * @param string|null $beneficiaryEmail Data must match e-mail format. Multiple e-mails are allowed using delimiter (;) (max 100 chars) - conditional
     * @param string $transactionInstructionDate Immediate/Current date (in yyyyMMdd format) (max 8 chars)
     * @param string $transactionPurposeCode Kode tujuan transaksi BI FAST (max 2 chars)
     * @return Object
     */

    public function domesticSingleBIFastTransfer(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_DOMESTIC_SINGLE_BI_FAST_TRANSFER;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitedAccountNo' => $params['debitedAccountNo'],
            'amountCurrency' => $params['amountCurrency'],
            'amount' => $params['amount'],
            'exchangeRateCode' => $params['exchangeRateCode'],
            'treasuryReferenceNo' => $params['treasuryReferenceNo'],
            'chargeTo' => $params['chargeTo'],
            'remark1' => $params['remark1'] ?? null,
            'remark2' => $params['remark2'] ?? null,
            'remark3' => $params['remark3'] ?? null,
            'remitterReferenceNo' => $params['remitterReferenceNo'] ?? null,
            'finalizePaymentFlag' => $params['finalizePaymentFlag'],
            'beneficiaryReferenceNo' => $params['beneficiaryReferenceNo'] ?? null,
            'usedProxy' => $params['usedProxy'],
            'beneficiaryAccountNo' => $params['beneficiaryAccountNo'],
            'proxyId' => $params['proxyId'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode'],
            'beneficiaryBankName' => $params['beneficiaryBankName'],
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'],
            'transactionInstructionDate' => $params['transactionInstructionDate'],
            'transactionPurposeCode' => $params['transactionPurposeCode']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>