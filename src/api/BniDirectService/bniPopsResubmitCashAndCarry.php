<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bniPopsResubmitCashAndCarryService
{
    public function bniPopsResubmitCashAndCarry(
        $corporateId,
        $userId,
        $transactionReferenceNo,
        $SONumber
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BNI_POPS_RESUBMIT_CASH_AND_CARRY . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'transactionReferenceNo' => $transactionReferenceNo,
            'SONumber' => $SONumber,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>