<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\OtrRemittance;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class OtrRemittanceTest extends TestCase
{

    public function getCredentials()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return $credentials->api_services;
    }

    private function init()
    {
        return new Bni(
            $env = 'sandbox',
            $clientId = $this->getCredentials()->clientId,
            $clientSecret = $this->getCredentials()->clientSecret,
            $apiKey = $this->getCredentials()->apiKey,
            $apiSecret = $this->getCredentials()->apiSecret,
            $appName = $this->getCredentials()->appName
        );
    }

    public function otrRemittance(Bni $bni){
        return new OtrRemittance(
            $bni,
            $this->getCredentials()->channelId
        );
    }

    public function test_otr_remittance_bank_and_currency_limitation()
    {
        $bni = $this->init();
        $otrRemittance = $this->otrRemittance($bni);
        $response = $otrRemittance->bankAndCurrencyLimitation(
            $serviceType = 'SWIFT',
            $country = 'SG'
        );
        $this->assertEquals($response->statusCode, '0');
    }

    public function test_otr_remittance_pre_transaction_rate_inquiry()
    {
        $bni = $this->init();
        $otrRemittance = $this->otrRemittance($bni);
        $response = $otrRemittance->preTranscationRateInquiry(
            $orderingId = 'RESTTEST04',
            $bic = 'INITU123456',
            $serviceType = 'NON-SWIFT',
            $sourceCcy = 'SGD',
            $orderingCcy = 'USD',
            $detailCharges = 'SHA',
            $orderingAmount = 5000
        );
        $this->assertEquals($response->code, '200');
    }
    public function test_otr_remittance_otr_stp_nonstp()
    {
        $bni = $this->init();
        $otrRemittance = $this->otrRemittance($bni);
        $response = $otrRemittance->OtrStpNonStp(
            $referenceNumber = 'GLBS10032959',
            $orderingId = 'RESTTEST26',
            $orderingBic = 'CITIUS30XXX',
            $orderingName = 'Nama',
            $orderingAddress = 'Alamatnya',
            $orderingEmail = 'nama@initu.com',
            $orderingPhoneNumber = '08091000100',
            $beneficiaryAccount = '72183810',
            $beneficiaryName = 'SIAPA YA',
            $beneficiaryAddress = 'Alamatmu',
            $beneficiaryPhoneNumber = '08091000101',
            $accountWithInstCode = 'A',
            $accountWithInstBic = 'CHASUS30XXX',
            $accountWithInstName = 'JPMORGAN',
            $remittanceInfo = 'PERSONAL',
            $invoiceNumber = 'INVOICE001',
            $invoiceAmount = 9000
        );
        $this->assertEquals($response->code, '200');
    }
    public function test_otr_remittance_gpi_tracker()
    {
        $bni = $this->init();
        $otrRemittance = $this->otrRemittance($bni);
        $response = $otrRemittance->GPITracker(
            $referenceNumber = 'S10JPUC000008224'
        );
        $this->assertEquals($response->code, '200');
    }

}
