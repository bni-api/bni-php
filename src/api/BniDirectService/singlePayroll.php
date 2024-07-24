<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait singlePayroll
{
    public function singlePayroll(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_SINGLE_PAYROLL;
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