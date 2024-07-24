<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bulkPaymentMixed
{
    /**
     * Bulk Payment Mixed
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $apiRefNo Api Reference No (max 1996 chars)
     * @param string $instructionDate Transaction Instruction Date - yyyyMMdd (max 8 chars)
     * @param string|null $session Instruction session (max 1 char) - optional
     * @param string $serviceType Bulk service type (max 10 chars)
     * @param string $debitAcctNo Debit account (max 16 chars)
     * @param string $amount Transaction amount (max 18 chars)
     * @param string $currency Currency transactions (max 3 chars)
     * @param string $chargeTo Charge To (max 3 chars)
     * @param string $residenceCode Remitter Country of Residence Code (max 40 chars)
     * @param string|null $citizenCode Citizenship code (max 40 chars) - optional
     * @param string|null $category Remitter category (max 40 chars) - optional
     * @param string $transactionType Transaction type (max 1 char)
     * @param string|null $remark Description (max 100 chars) - optional
     * @param string $accountNmValidation Beneficiary account name validation flag (max 1 char)
     * @param string $childContent List of transaction details (child of bulk)
     * @return Object
     */

    public function bulkPaymentMixed(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BULK_PAYMENT_MIXED;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'apiRefNo' => $params['apiRefNo'],
            'instructionDate' => $params['instructionDate'],
            'session' => $params['session'],
            'serviceType' => $params['serviceType'],
            'debitAcctNo' => $params['debitAcctNo'],
            'amount' => $params['amount'],
            'currency' => $params['currency'],
            'chargeTo' => $params['chargeTo'],
            'residenceCode' => $params['residenceCode'],
            'citizenCode' => $params['citizenCode'] ?? null,
            'category' => $params['category'] ?? null,
            'transactionType' => $params['transactionType'],
            'accountNmValidation' => $params['accountNmValidation'],
            'remark' => $params['remark'] ?? null,
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