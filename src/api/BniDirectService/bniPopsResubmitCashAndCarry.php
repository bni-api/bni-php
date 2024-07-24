<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bniPopsResubmitCashAndCarryService
{
    /**
     * BNI POPS – Resubmit Cash and Carry
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $transactionReferenceNo Transaction Reference No. (max 40 chars)
     * @param string|null $SONumber SO Number (max 40 chars) - optional
     * @return Object
     */

    public function bniPopsResubmitCashAndCarry(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BNI_POPS_RESUBMIT_CASH_AND_CARRY;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'transactionReferenceNo' => $params['transactionReferenceNo'],
            'SONumber' => $params['SONumber'] ?? null,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>