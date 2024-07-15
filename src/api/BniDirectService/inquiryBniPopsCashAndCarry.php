<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBniPopsCashAndCarryService
{
    public function inquiryBniPopsCashAndCarry(
        string $corporateId,
        string $userId,
        string $debitAccountNo,
        string $salesOrganizationCode,
        string $distributionChannelCode,
        string $productCode,
        string $shipTo,
        int $debitOrCreditNoteNo,
        string $materialCode,
        string $trip,
        string $quantity,
        string $deliveryDate,
        string $transportir
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_BNI_POPS_CASH_AND_CARRY . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitAccountNo' => $debitAccountNo,
            'salesOrganizationCode' => $salesOrganizationCode,
            'distributionChannelCode' => $distributionChannelCode,
            'productCode' => $productCode,
            'shipTo' => $shipTo,
            'debitOrCreditNoteNo' => $debitOrCreditNoteNo,
            'productInformationDetail' => [
                'materialCode' => $materialCode,
                'trip' => $trip,
                'quantity' => $quantity,
                'deliveryDate' => $deliveryDate,
                'transportir' => $transportir
            ]
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}
?>