<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\RDF;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class RDFTest extends TestCase
{

    private function init()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new Bni(
            $env = 'new_dev',
            $clientId = $credentials->one_gate_payment->clientId,
            $clientSecret = $credentials->one_gate_payment->clientSecret,
            $apiKey = $credentials->one_gate_payment->apiKey,
            $apiSecret = $credentials->one_gate_payment->apiSecret,
            $appName = $credentials->one_gate_payment->appName
        );
    }

    public function test_rdf_registerInvestor()
    {
        $bni = $this->init();
        $rdf = new RDF($bni);
        $response = $rdf->registerInvestor(
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

    // public function test_rdf_faceRecognition()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->faceRecognition(
    //     'SANDBOX',
    //     'STI_CHS"',
    //     'MOHAMMAD',
    //     'BAQER',
    //     'ZALQAD',
    //     '0141111121260118',
    //     '29-09-2021',
    //     'BANDUNG',
    //     'M',
    //     'Bandung',
    //     'Jawa Barat',
    //     'ID',
    //     'bandung',
    //     'bandung',
    //     '40914',
    //     'ID',
    //     'AlwSFlzAAAOxAAADsQBlSsOGwAAABl0RVh0UBoAACAASURBVHic7N13nFxXfffxz7lTtmi10qpLYAAAD0eNT6AAAABHNCSVQICAgIfAhkiAAAAiVBORw0KGgoAAAANSUhEUgAAAgAAAAIACA'
    //     );
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_registerInvestorAccount()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->registerInvestorAccount('NI001', 'KSEI', '9100749959', 'IDR', '2', '1', '0259', '19050813401', 'NI001CX5U00109');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_inquiryAccountBalance()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->inquiryAccountBalance('NI001', 'KSEI', '0115476117');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_inquiryAccountHistory()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->inquiryAccountHistory('NI001', 'KSEI', '0115476117');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_PaymentUsingTranfer()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->paymentUsingTransfer('NI001', 'KSEI', '0115476117', '0115471119', 'IDR', 11500, 'Test RDN');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_PaymentUsingClearing()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->paymentUsingClearing('NI001', 'KSEI', '0115476117', '3333333333', 'Jakarta', '', '140397', 'Panji Samudra', 'IDR', 15000, 'Test kliring', 'OUR');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_inquiryAccountInfo()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->inquiryAccountInfo('NI001', 'KSEI', '0115476117');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_PaymentUsingRTGS()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->paymentUsingRTGS('NI001', 'KSEI', '0115476117', '3333333333', 'Jakarta', '', 'CENAIDJA', 'Panji Samudra', 'IDR', 120000000, 'Test rtgs', 'OUR');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_inquiryInterbankAccount()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->inquiryInterbankAccount('NI001', 'KSEI', '0115476117', '013', '01300000');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_inquiryPaymentStatus()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->inquiryPaymentStatus('NI001', 'KSEI', 'E8C6E0027F6E429F');
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

    // public function test_rdf_paymentUsingInterbank()
    // {
    //     $bni = $this->init();
    //     $rdf = new RDF($bni);
    //     $response = $rdf->paymentUsingInterbank('NI001', 'KSEI', '0115476117', '3333333333', 'KEN AROK', '014', 'BANK BCA', 15000);
    //     $this->assertEquals($response->response->responseCode, '0001');
    // }

}
