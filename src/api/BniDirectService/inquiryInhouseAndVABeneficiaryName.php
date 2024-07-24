<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryInhouseAndVABeneficiaryNameService
{
    /**
     * Inquiry InHouse and VA Beneficiary Name
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $accountNo Account No. (max 16 chars)
     * @return Object
     */

    public function inquiryInhouseAndVABeneficiaryName(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_INHOUSE_AND_VA_BENEFICIARY_NAME;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'accountNo' => $params['accountNo']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>