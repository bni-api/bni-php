<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait inquiryBniPopsProductAllocation
{
    public function inquiryBniPopsProductAllocation(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $salesOrganizationCode,
        string $distributionChannelCode,
        string $productCode,
        string $shipTo,
        string $scheduleAggreementNo,
        string $debitOrCreditNoteNo,
        array $productInformationDetail,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_INQUIRY_BNI_POPS_PRODUCT_ALLOCATION . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'salesOrganizationCode' => $salesOrganizationCode,
            'distributionChannelCode' => $distributionChannelCode,
            'productCode' => $productCode,
            'shipTo' => $shipTo,
            'scheduleAggreementNo' => $scheduleAggreementNo,
            'debitOrCreditNoteNo' => $debitOrCreditNoteNo,
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