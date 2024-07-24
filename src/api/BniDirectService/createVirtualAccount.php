<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait createVirtualAccountService
{
    /**
     * Create Virtual Account
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $companyCode Company Code (max 20 chars)
     * @param string $virtualAccountNo Virtual Account No. (varying length)
     * @param string $virtualAccountName Virtual Account Name (max 80 chars)
     * @param string $virtualAccountTypeCode Virtual Account Type Code (max 2 chars)
     * @param string $billingAmount Billing Amount (max 12v2 chars) - Yes (conditional)
     * @param string $varAmount1 Var Amount 1 (max 12v2 chars) - Yes (conditional)
     * @param string $varAmount2 Var Amount 2 (max 12v2 chars) - Yes (conditional)
     * @param string $expiryDate Expiry Date (max 8 chars) - Yes (conditional)
     * @param string $expiryTime Expiry Time (max 8 chars) - Yes (conditional)
     * @param string $mobilePhoneNo Mobile Phone No. (max 100 chars) - Yes (conditional)
     * @param string $statusCode Status Code. 1 = Active, 2 = Inactive (max 1 char)
     * @return Object
     */

    public function createVirtualAccount(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_CREATE_VIRTUAL_ACCOUNT;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'companyCode' => $params['companyCode'],
            'virtualAccountNo' => $params['virtualAccountNo'],
            'virtualAccountName' => $params['virtualAccountName'],
            'virtualAccountTypeCode' => $params['virtualAccountTypeCode'],
            'billingAmount' => $params['billingAmount'],
            'varAmount1' => $params['varAmount1'],
            'varAmount2' => $params['varAmount2'],
            'expiryDate' => $params['expiryDate'],
            'expiryTime' => $params['expiryTime'],
            'mobilePhoneNo' => $params['mobilePhoneNo'],
            'statusCode' => $params['statusCode'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>