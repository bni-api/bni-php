<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait updateVirtualAccountService
{
    public function updateVirtualAccount(
        $corporateId,
        $userId,
        $companyCode,
        $virtualAccountNo,
        $virtualAccountName,
        $virtualAccountTypeCode,
        $billingAmount,
        $varAmount1,
        $varAmount2,
        $expiryDate,
        $expiryTime,
        $mobilePhoneNo,
        $statusCode
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_UPDATE_VIRTUAL_ACCOUNT . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'companyCode' => $fileRefNo,
            'virtualAccountNo' => $apiRefNo,
            'virtualAccountName' => $virtualAccountName,
            'virtualAccountTypeCode' => $virtualAccountTypeCode,
            'billingAmount' => $billingAmount,
            'varAmount1' => $varAmount1,
            'varAmount2' => $varAmount2,
            'expiryDate' => $expiryDate,
            'expiryTime' => $expiryTime,
            'mobilePhoneNo' => $mobilePhoneNo,
            'statusCode' => $statusCode,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>