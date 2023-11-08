<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBillingService
{
    public function inquiryBilling(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $institution,
        string $customerInformation1,
        string $customerInformation2,
        string $customerInformation3,
        string $customerInformation4,
        string $customerInformation5,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_REGULER_TRANSACTION . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'institution' => $institution,
            'customerInformation1' => $customerInformation1,
            'customerInformation2' => $customerInformation2,
            'customerInformation3' => $customerInformation3,
            'customerInformation4' => $customerInformation4,
            'customerInformation5' => $customerInformation5
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>