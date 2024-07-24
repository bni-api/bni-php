<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait balanceInquiry
{
    /**
     * Balance Inquiry
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string[] $accountList List of Account (array of strings)
     * @return Object
     */

    public function balanceInquiry(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BALANCE_INQUIRY;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'accountList' => $params['accountList']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>