<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryAccountStatementService
{
    public function inquiryAccountStatement(
        string $corporateId,
        string $userId,
        string $fromDate,
        string $toDate,
        string $transactionType,
        string $accountList
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_REGULER_TRANSACTION . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'transactionType' => $transactionType,
            'accountList' => explode(",", $accountList)
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>