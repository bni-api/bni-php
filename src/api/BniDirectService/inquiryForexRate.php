<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryForexRate
{
    public function inquiryForexRate(
        string $corporateId,
        string $userId,
        array $currencyList
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_FOREX_RATE . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'currencyList' => $currencyList
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>