<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\Ecollection;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;


class EcollectionTest extends TestCase
{

    public function getCredentials()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return $credentials->ecollection;
    }
    private function init()
    {
        return new Bni(
            $env = 'dev',
            $clientId = $this->getCredentials()->clientId,
            $clientSecret = $this->getCredentials()->clientSecret,
            $apiKey = $this->getCredentials()->apiKey,
            $apiSecret = $this->getCredentials()->apiSecret,
            $appName = $this->getCredentials()->appName
        );
    }

    public function ecollection(Bni $bni)
    {
        return new Ecollection(
            $bni
        );
    }

    public function test_ecollection_createBilling()
    {
        $bni = $this->init();
        $snap = $this->ecollection($bni);
        $response = $snap->createBilling(
            $trxId = "createbilling-" . date("YmdHis"),
            $trxAmount = "10000",
            $billingType = "c",
            $customerName = "customer-name",
            $customerEmail = "customer-email@mail.com",
            $customerPhone = "628123123",
            $virtualAccount = "",
            $datetimeExpired = "2023-12-31T23:59:59+07:00",
            $description = "test description"
        );
        $this->assertEquals('000', $response->status);
    }
    
    public function test_ecollection_updateBilling()
    {
        $bni = $this->init();
        $snap = $this->ecollection($bni);
        $response = $snap->updateBilling(
            $trxId = $this->getCredentials()->trxIdForTest,
            $trxAmount = "99000",
            $customerName = "customer-name-updated",
            $customerEmail = "customer-email-updated@mail.com",
            $customerPhone = "6281231234567",
            $virtualAccount = $this->getCredentials()->virtualAccountForTest ?? "",
            $datetimeExpired = "2023-12-31T23:59:59+07:00",
            $description = "test description updated"
        );
        $this->assertEquals('000', $response->status);
    }
    
    public function test_ecollection_inquiryBilling()
    {
        $bni = $this->init();
        $snap = $this->ecollection($bni);
        $response = $snap->inquiryBilling(
            $trxId = $this->getCredentials()->trxIdForTest,
        );
        $this->assertEquals('000', $response->status);
    }

    public function test_ecollection_inactiveBilling()
    {
        $bni = $this->init();
        $snap = $this->ecollection($bni);
        $response = $snap->inactiveBilling(
            $trxId = $this->getCredentials()->trxIdForTest,
            $virtualAccount = $this->getCredentials()->virtualAccountForTest
        );
        $this->assertEquals('000', $response->status);
    }
}