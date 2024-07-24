<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryLLG_RTGS_OnlineBeneficiaryNameService
{
    /**
     * Inquiry LLG/RTGS/Online Beneficiary Name
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $beneficiaryAccountNo Beneficiary Account No. (max 16 chars)
     * @param string $beneficiaryBankCode Beneficiary Bank Code (max 40 chars)
     * @return Object
     */

    public function inquiryLLG_RTGS_OnlineBeneficiaryName(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_LLG_RTGS_ONLINE_BENEFICIARY_NAME;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'beneficiaryAccountNo' => $params['beneficiaryAccountNo'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>