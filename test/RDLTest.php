<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\RDL;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class RDLTest extends TestCase
{

    private function init()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new Bni(
            $env = 'sandbox-2',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName
        );
    }

    public function test_rdl_registerInvestor()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->registerInvestor(
            'SANDBOX',
            'STI_CHS',
            '492F33851D634CFB',
            '01',
            'Agus',
            '',
            'Saputra',
            '1',
            '001058893408123',
            'ID',
            'ID',
            '2',
            'Semarang',
            '14081982',
            'M',
            'S',
            'Dina Maryati',
            '01',
            '07',
            '01',
            '4147016201959998',
            'Jakarta Barat',
            '26102099',
            'Jalan Mawar Melati',
            '003009Sentosa',
            'Cengkareng Barat',
            'Cengkareng/Jakarta Barat',
            '11730',
            '0214',
            '7459',
            '',
            '',
            '0812',
            '12348331',
            '',
            '',
            'agus.saputra@gmail.com',
            '8000000',
            '0259',
            'PT. BNI SECURITIES',
            'IDD280436215354',
            'Salman',
            'St Baker',
            'Arrandelle',
            'Pedagang',
            '0337109074',
            '10122008'
        );
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_faceRecognition()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->faceRecognition(
            'SANDBOX',
            'STI_CHS',
            'MOHAMMAD',
            'BAQER',
            'ZALQAD',
            '0141111121260118',
            '29-09-2021',
            'BANDUNG',
            'M',
            'Bandung',
            'Jawa Barat',
            'ID',
            'bandung',
            'bandung',
            '40914',
            'ID',
            '29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuP'
        );
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_registerInvestorAccount()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->registerInvestorAccount('NI001', 'KSEI', '9100749959', 'IDR', '2', '1', '0259', '19050813401', 'NI001CX5U00109');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_inquiryAccountBalance()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->inquiryAccountBalance('NI001', 'KSEI', '0115476117');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_inquiryAccountHistory()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->inquiryAccountHistory('NI001', 'KSEI', '0115476117');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_PaymentUsingTranfer()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->paymentUsingTransfer('NI001', 'KSEI', '0115476117', '0115471119', 'IDR', 11500, 'Test RDN');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_PaymentUsingClearing()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->paymentUsingClearing('NI001', 'KSEI', '0115476117', '3333333333', 'Jakarta', '', '140397', 'Panji Samudra', 'IDR', 15000, 'Test kliring', 'OUR');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_inquiryAccountInfo()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->inquiryAccountInfo('NI001', 'KSEI', '0115476117');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_PaymentUsingRTGS()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->paymentUsingRTGS('NI001', 'KSEI', '0115476117', '3333333333', 'Jakarta', '', 'CENAIDJA', 'Panji Samudra', 'IDR', 120000000, 'Test rtgs', 'OUR');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_inquiryInterbankAccount()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->inquiryInterbankAccount('NI001', 'KSEI', '0115476117', '013', '01300000');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_inquiryPaymentStatus()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->inquiryPaymentStatus('NI001', 'KSEI', 'E8C6E0027F6E429F');
        $this->assertEquals($response->response->responseCode, '0001');
    }

    public function test_rdl_paymentUsingInterbank()
    {
        $bni = $this->init();
        $rdl = new RDL($bni);
        $response = $rdl->paymentUsingInterbank('NI001', 'KSEI', '0115476117', '3333333333', 'KEN AROK', '014', 'BANK BCA', 15000);
        $this->assertEquals($response->response->responseCode, '0001');
    }
}
