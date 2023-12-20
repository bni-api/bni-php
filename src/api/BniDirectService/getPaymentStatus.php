<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait getPaymentStatus
{
    public function getPaymentStatus(
        string $corporateId,
        string $userId,
        string $transactionReferenceNo,
        string $remitterReferenceNo,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_GET_PAYMENT_STATUS . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'transactionReferenceNo' => $transactionReferenceNo,
            'remitterReferenceNo' => $remitterReferenceNo,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>