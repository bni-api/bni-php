<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait balanceInquiry
{
    public function balanceInquiry(
        string $corporateId,
        string $userId,
        array $accountList
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BALANCE_INQUIRY . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'accountList' => $accountList
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>