<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryNPWPService
{
    /**
     * Inquiry NPWP
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $npwp NPWP (max 15 chars)
     * @param string|null $NOP Tax Object Number (NOP) (max 18 chars) - optional
     * @param string $MAPCode MAP/ Account Code (max 6 chars)
     * @param string $depositTypeCode Deposit Type Code (max 40 chars)
     * @param string $currency Currency Code (max 3 chars)
     * @return Object
     */

    public function inquiryNPWP(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_NPWP;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'npwp' => $params['npwp'],
            'NOP' => $params['NOP'] ?? null,
            'MAPCode' => $params['MAPCode'],
            'depositTypeCode' => $params['depositTypeCode'],
            'currency' => $params['currency']
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>