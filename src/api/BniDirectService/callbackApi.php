<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait callbackApi
{
    public function callbackApi(
        string $corporateId,
        string $userId,
        string $apiRefNo,
        string $status
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_CALLBACK_API . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'apiRefNo' => $apiRefNo,
            'status' => $status,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>