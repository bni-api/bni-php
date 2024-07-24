<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait createMPNG2BillingService
{
    /**
     * Create MPN G2 Billing ID
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $npwp NPWP (max 15 chars)
     * @param string $taxPayerName Tax Payer Name (max 100 chars)
     * @param string $taxPayerAddress1 Tax Payer Address (1) (max 50 chars)
     * @param string $taxPayerAddress2 Tax Payer Address (2) (max 50 chars) (optional)
     * @param string $taxPayerAddress3 Tax Payer Address (3) (max 50 chars) (optional)
     * @param string $taxPayerCity Tax Payer City (max 100 chars)
     * @param string $NOP Tax Object Number (NOP) (max 18 chars) (optional)
     * @param string $MAPCode MAP/Akun Code (max 6 chars)
     * @param string $depositTypeCode Deposit Type Code (max 40 chars)
     * @param string $wajibPungutNPWP Wajib Pungut NPWP (max 15 chars) (optional)
     * @param string $wajibPungutName Wajib Pungut Name (max 40 chars) (optional)
     * @param string $wajibPungutAddress1 Wajib Pungut Address (1) (max 40 chars) (optional)
     * @param string $wajibPungutAddress2 Wajib Pungut Address (2) (max 40 chars) (optional)
     * @param string $wajibPungutAddress3 Wajib Pungut Address (3) (max 40 chars) (optional)
     * @param string $participantId Participant ID (max 40 chars) (optional)
     * @param string $assessmentTaxNumber Assessment Tax Number (max 15 chars) (optional)
     * @param string $amountCurrency Amount Currency (max 3 chars)
     * @param string $amount Amount (max 15 chars)
     * @param string $monthFrom Month (From), e.g. 1-12 (max 2 chars)
     * @param string $monthTo Month (To), e.g. 1-12 (max 2 chars)
     * @param string $year Year (max 4 chars)
     * @param string $confirmNumber Confirm Number
     * @param string $traceId Trace ID (optional)
     * @param string $kelurahan Kelurahan (optional)
     * @param string $kecamatan Kecamatan (optional)
     * @param string $provinsi Provinsi (optional)
     * @param string $kota Kota (optional)
     * @return Object
     */

    public function createMPNG2Billing(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_CREATE_MPN_G2_BILLING_ID;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'npwp' => $params['npwp'],
            'taxPayerName' => $params['taxPayerName'],
            'taxPayerAddress1' => $params['taxPayerAddress1'],
            'taxPayerAddress2' => $params['taxPayerAddress2'] ?? null,
            'taxPayerAddress3' => $params['taxPayerAddress3'] ?? null,
            'taxPayerCity' => $params['taxPayerCity'],
            'NOP' => $params['NOP'] ?? null,
            'MAPCode' => $params['MAPCode'],
            'depositTypeCode' => $params['depositTypeCode'],
            'wajibPungutNPWP' => $params['wajibPungutNPWP'] ?? null,
            'wajibPungutName' => $params['wajibPungutName'] ?? null,
            'wajibPungutAddress1' => $params['wajibPungutAddress1'] ?? null,
            'wajibPungutAddress2' => $params['wajibPungutAddress2'] ?? null,
            'wajibPungutAddress3' => $params['wajibPungutAddress3'] ?? null,
            'participantId' => $params['participantId'] ?? null,
            'assesmentTaxNumber' => $params['assesmentTaxNumber'] ?? null,
            'amountCurrency' => $params['amountCurrency'],
            'amount' => $params['amount'],
            'monthFrom' => $params['monthFrom'],
            'monthTo' => $params['monthTo'],
            'year' => $params['year'],
            'confirmNumber' => $params['confirmNumber'],
            'traceId' => $params['traceId'] ?? null,
            'kelurahan' => $params['kelurahan'] ?? null,
            'kecamatan' => $params['kecamatan'] ?? null,
            'provinsi' => $params['provinsi'] ?? null,
            'kota' => $params['kota'] ?? null
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>