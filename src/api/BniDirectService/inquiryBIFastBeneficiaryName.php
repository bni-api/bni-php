<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBIFastBeneficiaryName
{
    public function inquiryBIFastBeneficiaryName(
        string $corporateId,
        string $userId,
        string $usedProxy,
        string $beneficiaryAccountNo,
        string $proxyId,
        string $beneficiaryBankCode,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_BI_FAST_BENEFICIARY_NAME . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'usedProxy' => $usedProxy,
            'beneficiaryAccountNo' => $beneficiaryAccountNo,
            'proxyId' => $proxyId,
            'beneficiaryBankCode' => $beneficiaryBankCode,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>