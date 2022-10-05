<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\OneGatePayment;
use BniApi\BniPhp\Bni;
use Tests\TestCase;


class OneGatePaymentTest extends TestCase
{

    private function init()
    {
        $credentials = json_decode(file_get_contents(public_pat('constant.js')));

        return new Bni(
            $production = false,
            $clientId = $credentials->one_gate_payment->clientId,
            $clientSecret = $credentials->one_gate_payment->clientSecret,
            $apiKey = $credentials->one_gate_payment->apiKey,
            $apiSecret = $credentials->one_gate_payment->apiSecret,
            $appName = $credentials->one_gate_payment->appName
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

    public function test_ogp_getBalance_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->getBalance('1154711SS');
        } catch (\Exception $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_getInHouseInquiry_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->getInHouseInquiry('1154711SS');
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_doPayment_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->doPayment(
                '20170227000000000020SSSS',
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_getPaymentStatus_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->getPaymentStatus('20170227000000000020SSSS');
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_getInterBankInquiry_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->getInterBankInquiry(
                '20180930112233003SSSS',
                '0115476117',
                '014',
                '01400000'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_getInterBankPayment_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->getInterBankPayment(
                '20180930112233005SSSS',
                12007,
                '01400000',
                'Bpk HANS',
                '014',
                'BCA',
                '0316031099',
                '100000000097'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_holdAmount_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->holdAmount(
                '20181001112233009SSSS',
                12007,
                '0115476151',
                'testHold'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }

    public function test_ogp_holdAmountRelease_error()
    {
        try {
            $bni = $this->init();
            $ogp = new OneGatePayment($bni);
            $response = $ogp->holdAmountRelease(
                '20181001112233010SSSS',
                12007,
                '0115476151',
                '657364',
                '31052010'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertEquals($responseCode, '0007');
        }
    }
}
