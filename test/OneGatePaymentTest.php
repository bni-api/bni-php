<?php

namespace BniApi\BniPhp\test;

use Tests\TestCase;
use BniApi\BniPhp\api\OneGatePayment;
use BniApi\BniPhp\Bni;

class OneGatePaymentTest extends TestCase
{

    private function init()
    {
        return new Bni(
            false,
            'Test Wawat',
            'ff19bcb7-3a15-4d0b-97b1-f36f9cf9bdb2',
            'd227997a-3525-442d-b80e-2ab2e7d908f0',
            '98c4277f-866d-46b0-ba83-d3e0e37e667e',
            'b3b58219-8a88-401f-89c0-f2dc5bb7ce21'
        );
    }

    public function test_ogp_getBalance()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->getBalance('115471119');
        $this->assertEquals($response->getBalanceResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_getInHouseInquiry()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->getInHouseInquiry('115471119');
        $this->assertEquals($response->getInHouseInquiryResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_doPayment()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->doPayment(
            '20170227000000000020',
            '0',
            '113183203',
            '115471119',
            '20170227000000000',
            'IDR',
            100500,
            '?',
            '',
            'Mr.X',
            'Jakarta',
            '',
            'CENAIDJAXXX',
            'OUR'
        );
        $this->assertEquals($response->doPaymentResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_getPaymentStatus()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->getPaymentStatus('20170227000000000020');
        $this->assertEquals($response->getPaymentStatusResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_getInterBankInquiry()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->getInterBankInquiry(
            '20180930112233003',
            '0115476117',
            '014',
            '01400000'
        );
        $this->assertEquals($response->getInterbankInquiryResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_getInterBankPayment()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->getInterBankPayment(
            '20180930112233005',
            12007,
            '01400000',
            'Bpk HANS',
            '014',
            'BCA',
            '0316031099',
            '100000000097'
        );
        $this->assertEquals($response->getInterbankPaymentResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_holdAmount()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->holdAmount(
            '20181001112233009',
            12007,
            '0115476151',
            'testHold'
        );
        $this->assertEquals($response->holdAmountResponse->parameters->responseCode, '0001');
    }

    public function test_ogp_holdAmountRelease()
    {
        $bni = $this->init();
        $ogp = new OneGatePayment($bni);
        $response = $ogp->holdAmountRelease(
            '20181001112233010',
            12007,
            '0115476151',
            '657364',
            '31052010'
        );
        $this->assertEquals($response->holdAmountReleaseResponse->parameters->responseCode, '0001');
    }
}
