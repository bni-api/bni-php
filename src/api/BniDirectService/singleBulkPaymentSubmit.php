<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait singleBulkPaymentSubmit
{
    /**
     * Single Bulk Payment - Submit
     * @param string $corporateId Corporate ID (max 40 chars) - required
     * @param string $userId User ID (max 40 chars) - required
     * @param string $apiRefNo Api Reference No (max 1996 chars) - required
     * @return Object
     */

    public function singleBulkPaymentSubmit(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_SINGLE_BULK_PAYMENT_SUBMIT;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'apiRefNo' => $params['apiRefNo']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>