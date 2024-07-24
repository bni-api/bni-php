<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait payrollMixed
{
    /**
     * Payroll Mixed
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $apiRefNo Api Reference No (max 1996 chars)
     * @param string $instructionDate Transaction Instruction Date (yyyyMMdd, max 8 chars)
     * @param string|null $session Instruction Session (max 1 char) - optional
     * @param string $serviceType Bulk Service Type (max 10 chars)
     * @param string|null $debitAcctNo Debit Account No (max 16 chars) - optional
     * @param string|null $totalAmount Transaction Amount (max 18 chars with 7 decimal places) - optional
     * @param string|null $totalAmountCurrencyCode Total Amount Currency Code (max length not specified) - optional
     * @param string|null $currency Currency for Transactions (max 3 chars) - optional
     * @param string|null $chargeTo Charge To (max 3 chars) - optional
     * @param string|null $residenceCode Remitter Country of Residence Code (max 40 chars) - optional
     * @param string|null $citizenCode Citizenship Code (max 40 chars) - optional
     * @param string|null $remitterCategory Remitter Category (max 40 chars) - optional
     * @param string $transactionType Transaction Type (max 1 char)
     * @param string|null $remark Description (max 100 chars) - optional
     * @param string $accountNmValidation Beneficiary Account Name Validation Flag (max 1 char)
     * @param string $childContent List of Transaction Details (child of bulk)
     * @return Object
     */

    public function payrollMixed(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_PAYROLL_MIXED;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'apiRefNo' => $params['apiRefNo'],
            'instructionDate' => $params['instructionDate'],
            'session' => $params['session'] ?? null,
            'serviceType' => $params['serviceType'],
            'debitAcctNo' => $params['debitAcctNo'] ?? null,
            'totalAmount' => $params['totalAmount'] ?? null,
            'totalAmountCurrencyCode' => $params['totalAmountCurrencyCode'] ?? null,
            'currency' => $params['currency'] ?? null,
            'chargeTo' => $params['chargeTo'] ?? null,
            'residenceCode' => $params['residenceCode'] ?? null,
            'citizenCode' => $params['citizenCode'] ?? null,
            'remitterCategory' => $params['remitterCategory'] ?? null,
            'transactionType' => $params['transactionType'],
            'remark' => $params['remark'] ?? null,
            'accountNmValidation' => $params['accountNmValidation'],
            'childContent' => $params['childContent'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>