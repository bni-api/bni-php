<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryLLG_RTGS_OnlineBeneficiaryNameService
{
    public function inquiryLLG_RTGS_OnlineBeneficiaryName(
        string $corporateId,
        string $userId,
        string $beneficiaryAccountNo,
        string $beneficiaryBankCode
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_LLG_RTGS_ONLINE_BENEFICIARY_NAME . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'beneficiaryBankCode' => $beneficiaryBankCode
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>