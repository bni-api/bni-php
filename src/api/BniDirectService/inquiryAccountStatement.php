<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryAccountStatementService
{
    /**
     * Inquiry Account Statement
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $fromDate From Posting Date, e.g. yyyyMMdd (max 8 chars)
     * @param string $toDate To Posting Date (max 8 chars)
     * @param string $transactionType Transaction Type, e.g. - All: Semua tipe - Db: Debit - Cr: Credit (max 3 chars)
     * @return Object
     */

    public function inquiryAccountStatement(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_ACCOUNT_STATEMENT;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'fromDate' => $params['fromDate'],
            'toDate' => $params['toDate'],
            'transactionType' => $params['transactionType'],
            'accountList' => $params['accountList']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>