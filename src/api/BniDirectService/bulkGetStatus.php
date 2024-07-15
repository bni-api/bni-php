<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bulkGetStatusService
{
    public function bulkGetStatus(
        $corporateId,
        $userId,
        $fileRefNo,
        $apiRefNo
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BULK_GET_STATUS . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'fileRefNo' => $fileRefNo,
            'apiRefNo' => $apiRefNo,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>