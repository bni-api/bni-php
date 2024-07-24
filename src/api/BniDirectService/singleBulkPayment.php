<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait singleBulkPayment
{
    /**
     * Single Bulk Payment
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $apiRefNo Api Reference No (max 1996 chars)
     * @param string $instructionDate Transaction Instruction Date (yyyyMMdd, max 8 chars) - conditional
     * @param string|null $session Instruction Session (max 1 char) - optional
     * @param string $serviceType Bulk Service Type (max 10 chars)
     * @param string $isSTP Flag STP (Y/N) (max 1 char)
     * @param string $transactionType Transaction Type (max 1 char)
     * @param string|null $remark Description (max 100 chars) - optional
     * @param string $accountNmValidation Beneficiary Account Name Validation Flag (max 1 char)
     * @param array $transactionDetail List of Transaction Details (child of bulk) - required
     * @param string|null $transactionDetail[benBankAddr3] Bank Address 3 (max 50 chars) - optional
     * @param string|null $transactionDetail[benBankCityNm] Bank City (max 100 chars) - optional
     * @param string $transactionDetail[benBankCountryNm] Bank Country (max 100 chars)
     * @param string $transactionDetail[benResidenceCd] Residence Code (max 40 chars)
     * @param string $transactionDetail[benCountryCd] Citizenship Code (max 40 chars)
     * @param string|null $transactionDetail[benEmail] Beneficiary Email (max 100 chars) - optional
     * @param string|null $transactionDetail[benPhone] Beneficiary Phone (max 100 chars) - optional
     * @param string|null $transactionDetail[benFax] Beneficiary Fax (max 100 chars) - optional
     * @param string|null $transactionDetail[correspondentBank] Correspondent Bank (max 40 chars) - optional
     * @param string $transactionDetail[purposeCode] Transaction Purpose Code (max 40 chars)
     * @param string|null $transactionDetail[affiliate] Affiliate Relationship (Y/N, max 1 char) - optional
     * @param string|null $transactionDetail[identical] Identical Status (Y/N, max 1 char) - optional
     * @param string|null $transactionDetail[benCategory] Beneficiary Category (max 40 chars) - optional
     * @param string|null $transactionDetail[lldDescription] LLD Description (max 500 chars) - optional
     * @param string $transactionDetail[orderPartyRefNo] Order Party Reference No (max 16 chars)
     * @param string|null $transactionDetail[finalizePayment] Final Payment Reference (Y/N, max 1 char) - optional
     * @param string|null $transactionDetail[counterPartyRefNo] Counter Party Reference No (max 16 chars) - optional
     * @param string|null $transactionDetail[extraDetail1] Extra Detail 1 (max 2000 chars) - optional
     * @param string|null $transactionDetail[extraDetail2] Extra Detail 2 (max 2000 chars) - optional
     * @param string|null $transactionDetail[extraDetail3] Extra Detail 3 (max 2000 chars) - optional
     * @param string|null $transactionDetail[extraDetail4] Extra Detail 4 (max 2000 chars) - optional
     * @param string|null $transactionDetail[extraDetail5] Extra Detail 5 (max 2000 chars) - optional
     * @param string|null $transactionDetail[typeCode] Type Code (1/2/3/4, max 2 chars) - optional
     * @param string $transactionDetail[mixedServiceCode] Mixed Service Code (IHT, LLG, OT, RTGS, BIFAST, IFT, max 40 chars)
     * @param string $transactionDetail[mixedCurrency] Mixed Currency (max 40 chars)
     * @param string $transactionDetail[mixedDebitAcctNo] Mixed Debit Account No (max 16 chars)
     * @param string $transactionDetail[mixedChargeTo] Charge To (max 3 chars)
     * @param string $transactionDetail[mixedRemCountryCode] Remitter Country Code (max 40 chars)
     * @param string $transactionDetail[mixedRemCitizenCode] Remitter Citizenship Code (max 40 chars)
     * @param string $transactionDetail[mixedRemCategory] Remitter Category Code (max 40 chars)
     * @param string|null $transactionDetail[proxyId] Proxy ID (max 50 chars) - optional
     * @param string|null $transactionDetail[proxyFlag] Proxy Flag (Y = Proxy ID, N = Account No, max 1 char) - optional for BIFast
     * @return Object
     */

    public function singleBulkPayment(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_SINGLE_BULK_PAYMENT;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'apiRefNo' => $params['apiRefNo'],
            'instructionDate' => $params['instructionDate'],
            'session' => $params['session'] ?? null,
            'serviceType' => $params['serviceType'],
            'isSTP' => $params['isSTP'],
            'transactionType' => $params['transactionType'],
            'remark' => $params['remark'] ?? null,
            'accountNmValidation' => $params['accountNmValidation'],
            'transactionDetail' => []
        ];

        foreach ($params['transactionDetail'] as $detail) {
            $data['transactionDetail'][] = [
                'creditAcctNo' => $detail['creditAcctNo'],
                'creditAcctNm' => $detail['creditAcctNm'],
                'amount' => $detail['amount'],
                'treasury' => $detail['treasury'] ?? null,
                'remark1' => $detail['remark1'] ?? null,
                'remark2' => $detail['remark2'] ?? null,
                'remark3' => $detail['remark3'] ?? null,
                'benAddr1' => $detail['benAddr1'] ?? null,
                'benAddr2' => $detail['benAddr2'] ?? null,
                'benAddr3' => $detail['benAddr3'] ?? null,
                'benBankCode' => $detail['benBankCode'],
                'benBankNm' => $detail['benBankNm'],
                'benBranchNm' => $detail['benBranchNm'] ?? null,
                'benBankAddr1' => $detail['benBankAddr1'] ?? null,
                'benBankAddr2' => $detail['benBankAddr2'] ?? null,
                'benBankAddr3' => $detail['benBankAddr3'] ?? null,
                'benBankCityNm' => $detail['benBankCityNm'] ?? null,
                'benBankCountryNm' => $detail['benBankCountryNm'],
                'benResidenceCd' => $detail['benResidenceCd'],
                'benCountryCd' => $detail['benCountryCd'],
                'benEmail' => $detail['benEmail'] ?? null,
                'benPhone' => $detail['benPhone'] ?? null,
                'benFax' => $detail['benFax'] ?? null,
                'correspondentBank' => $detail['correspondentBank'] ?? null,
                'purposeCode' => $detail['purposeCode'],
                'affiliate' => $detail['affiliate'] ?? null,
                'identical' => $detail['identical'] ?? null,
                'benCategory' => $detail['benCategory'] ?? null,
                'lldDescription' => $detail['lldDescription'] ?? null,
                'orderPartyRefNo' => $detail['orderPartyRefNo'],
                'finalizePayment' => $detail['finalizePayment'] ?? null,
                'counterPartyRefNo' => $detail['counterPartyRefNo'] ?? null,
                'extraDetail1' => $detail['extraDetail1'] ?? null,
                'extraDetail2' => $detail['extraDetail2'] ?? null,
                'extraDetail3' => $detail['extraDetail3'] ?? null,
                'extraDetail4' => $detail['extraDetail4'] ?? null,
                'extraDetail5' => $detail['extraDetail5'] ?? null,
                'typeCode' => $detail['typeCode'] ?? null,
                'mixedServiceCode' => $detail['mixedServiceCode'],
                'mixedCurrency' => $detail['mixedCurrency'],
                'mixedDebitAcctNo' => $detail['mixedDebitAcctNo'],
                'mixedChargeTo' => $detail['mixedChargeTo'],
                'mixedRemCountryCode' => $detail['mixedRemCountryCode'],
                'mixedRemCitizenCode' => $detail['mixedRemCitizenCode'],
                'mixedRemCategory' => $detail['mixedRemCategory'],
                'proxyId' => $detail['proxyId'] ?? null,
                'proxyFlag' => $detail['proxyFlag'] ?? null
            ];
        }

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>