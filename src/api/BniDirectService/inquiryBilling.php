<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBillingService
{
    /**
     * Inquiry Billing
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $debitedAccountNo Debited Account (max 16 chars)
     * @param string $institution Institution (max 40 chars)
     * @param string $customerInformation1 Customer Information (1) (max length not specified)
     * @param string|null $customerInformation2 Customer Information (2) (max length not specified) - optional
     * @param string|null $customerInformation3 Customer Information (3) (max length not specified) - optional
     * @param string|null $customerInformation4 Customer Information (4) (max length not specified) - optional
     * @param string|null $customerInformation5 Customer Information (5) (max length not specified) - optional
     * @return Object
     */

    public function inquiryBilling(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_BILLING;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitedAccountNo' => $params['debitedAccountNo'],
            'institution' => $params['institution'],
            'customerInformation1' => $params['customerInformation1'],
            'customerInformation2' => $params['customerInformation2'] ?? null,
            'customerInformation3' => $params['customerInformation3'] ?? null,
            'customerInformation4' => $params['customerInformation4'] ?? null,
            'customerInformation5' => $params['customerInformation5'] ?? null
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>