<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait bulkGetStatusService
{
    /**
     * Bulk Get Status
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string|null $fileRefNo File Reference No. (max 40 chars) - optional
     * @param string $apiRefNo Api Reference (max 1996 chars)
     * @return Object
     */

    public function bulkGetStatus(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BULK_GET_STATUS;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'fileRefNo' => $params['fileRefNo'] ?? null,
            'apiRefNo' => $params['apiRefNo'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>