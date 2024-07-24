<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBIFastBeneficiaryName
{
    /**
     * Inquiry BI Fast Beneficiary Name
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $usedProxy “Y” = Proxy ID, “N” = Account no. (max 1 char)
     * @param string|null $beneficiaryAccountNo Account number (max 16 chars) - required if `usedProxy` is “N”
     * @param string|null $proxyId Proxy ID (max 100 chars) - required if `usedProxy` is “Y”
     * @param string $beneficiaryBankCode Data must match BIC/RTGS Code or BIFAST Bank Code (max 40 chars)
     * @return Object
     */

    public function inquiryBIFastBeneficiaryName(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_BI_FAST_BENEFICIARY_NAME;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'usedProxy' => $params['usedProxy'],
            'beneficiaryAccountNo' => $params['beneficiaryAccountNo'],
            'proxyId' => $params['proxyId'],
            'beneficiaryBankCode' => $params['beneficiaryBankCode'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>