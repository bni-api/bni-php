<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryChildAccount
{
    public function inquiryChildAccount(
        string $corporateId,
        string $userId,
        string $accountNo
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_CHILD_ACCOUNT . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'accountNo' => $accountNo
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>