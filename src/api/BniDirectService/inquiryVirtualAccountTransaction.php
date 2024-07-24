<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryVirtualAccountTransaction
{
    /**
     * Inquiry Virtual Account Transaction
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $virtualAccountNo Virtual Account No. (max 40 chars)
     * @param string $fromDate From Date (yyyyMMdd, max 8 chars)
     * @param string $toDate To Date (yyyyMMdd, max 8 chars)
     * @return Object
     */

    public function inquiryVirtualAccountTransaction(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_VIRTUAL_ACCOUNT_TRANSACTION;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'virtualAccountNo' => $params['virtualAccountNo'],
            'fromDate' => $params['fromDate'],
            'toDate' => $params['toDate']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>