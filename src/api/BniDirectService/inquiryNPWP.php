<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryNPWPService
{
    public function inquiryNPWP(
        string $corporateId,
        string $userId,
        string $NOP,
        string $mapCode,
        string $depositTypeCode,
        string $currency
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_NPWP . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'NOP' => $NOP,
            'mapCode' => $mapCode,
            'depositTypeCode' => $depositTypeCode,
            'currency' => $currency
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>