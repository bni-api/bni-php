<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait getPaymentStatus
{
    /**
     * Get Payment Status
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $transactionReferenceNo Transaction Reference No. (max 40 chars)
     * @param string|null $remitterReferenceNo Remitter Reference No. (max 16 chars) - optional
     * @return Object
     */

    public function getPaymentStatus(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_GET_PAYMENT_STATUS;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'transactionReferenceNo' => $params['transactionReferenceNo'],
            'remitterReferenceNo' => $params['remitterReferenceNo'] ?? null,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>