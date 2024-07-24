<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bniPopsProductAllocationService
{
    /**
     * BNI POPS – Product Allocation
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $debitedAccountNo Debited Account (max 16 chars)
     * @param string $salesOrganizationCode Sales Organization Code (max 40 chars)
     * @param string $distributionChannelCode Distribution Channel Code (max 40 chars)
     * @param string $productCode Product Code (max 40 chars)
     * @param string $shipTo Ship To (max 100 chars)
     * @param string $scheduleAggreementNo Schedule Agreement Number (max 100 chars)
     * @param string|null $debitOrCreditNoteNo Debit / Credit Note Number (max 18 chars) - optional
     * @param array $productInformationDetail Product Information Detail. Each item in the array should be an object with the following properties:
     * - string $materialCode Material Code (max 40 chars)
     * - string $trip Trip (max 100 chars)
     * - string $quantity Quantity per Trip (max 100 chars)
     * - string $deliveryDate Delivery Date (max 8 chars)
     * - string|null $transportir Transportir (max 100 chars) - optional
     * @return Object
     */

    public function bniPopsProductAllocation(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BNI_POPS_PRODUCT_ALLOCATION;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitAccountNo' => $params['debitAccountNo'],
            'salesOrganizationCode' => $params['salesOrganizationCode'],
            'distributionChannelCode' => $params['distributionChannelCode'],
            'productCode' => $params['productCode'],
            'shipTo' => $params['shipTo'],
            'scheduleAggreementNo' => $params['scheduleAggreementNo'],
            'debitOrCreditNoteNo' => $params['debitOrCreditNoteNo'] ?? null,
            'productInformationDetail' => []
        ];

        foreach ($params['productInformationDetail'] as $detail) {
            $data['productInformationDetail'][] = [
                'materialCode' => $detail['materialCode'],
                'trip' => $detail['trip'],
                'quantity' => $detail['quantity'],
                'deliveryDate' => $detail['deliveryDate'],
                'transportir' => $detail['transportir'] ?? null
            ];
        }

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>