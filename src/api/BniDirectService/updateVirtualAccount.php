<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait updateVirtualAccountService
{
    /**
     * Update Virtual Account
     * @param string $corporateId Corporate ID (max 40 chars) - required
     * @param string $userId User ID (max 40 chars) - required
     * @param string $companyCode Company Code (max 20 chars) - required
     * @param string $virtualAccountNo Virtual Account No (varying length) - required
     * @param string $virtualAccountName Virtual Account Name (max 80 chars) - required
     * @param string $virtualAccountTypeCode Virtual Account Type Code (max 2 chars) - required
     * @param string|null $billingAmount Billing Amount (max 12 chars, 2 decimals) - conditional
     * @param string|null $varAmount1 Variable Amount 1 (max 12 chars, 2 decimals) - conditional
     * @param string|null $varAmount2 Variable Amount 2 (max 12 chars, 2 decimals) - conditional
     * @param string|null $expiryDate Expiry Date (max 8 chars, yyyyMMdd format) - conditional
     * @param string|null $expiryTime Expiry Time (max 8 chars) - conditional
     * @param string|null $mobilePhoneNo Mobile Phone No (max 100 chars) - conditional
     * @param string $statusCode Status Code (1 char, 1 = Active, 2 = Inactive) - required
     * @return Object
     */

    public function updateVirtualAccount(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_UPDATE_VIRTUAL_ACCOUNT;
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