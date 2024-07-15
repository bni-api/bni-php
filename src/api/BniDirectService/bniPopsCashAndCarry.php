<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bniPopsCashAndCarryService
{
    public function bniPopsCashAndCarry(
        string $corporateId,
        string $userId,
        string $debitAccountNo,
        string $salesOrganizationCode,
        string $distributionChannelCode,
        string $productCode,
        string $shipTo,
        string $debitOrCreditNoteNo,
        array $productInformationDetail
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BNI_POPS_CASH_AND_CARRY . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitAccountNo' => $debitAccountNo,
            'salesOrganizationCode' => $salesOrganizationCode,
            'distributionChannelCode' => $distributionChannelCode,
            'productCode' => $productCode,
            'shipTo' => $shipTo,
            'debitOrCreditNoteNo' => $debitOrCreditNoteNo,
            // 'productInformationDetail' => array(
            //     (object) array('materialCode' => $productInformationDetail->materialCode)
            // )
            'productInformationDetail' => $productInformationDetail
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>