<?php  

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\FSCM;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class FSCMTest extends TestCase
{
    private function init()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new Bni(
            $env = 'dev-2',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName
        );
    }

    public function test_fscm_sendInvoice()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->sendInvoice(
            'test-uuid-send-invoice',
            'sigbni',
            'INV_TEST111',
            '142',
            '23/10/2023',
            '1000',
            'IDR',
            '22/10/2023',
            '2023-10-23 09:34:00',
            '',
            '7900',
            ''
        );
        $this->assertEquals($response->error_code, '0000');
    }

    public function test_fscm_inquiry()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->inquiry(
            'test-uuid-inquiry"',
            '7900',
            'sigbni',
            'INV20231023JKL5',
            '2023-01-04 16:50:00',
            '142',
        );
        $this->assertEquals($response->error_code, '0001');
    }

    public function test_fscm_checkTransactionPlafond()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->checkTransactionPlafond(
            'test-uuid-check',
            '7900',
            'CREDIT',
            'IDR',
            '2023-01-04 13:47:00',
            '142',
            '30000000000'
        );
        $this->assertEquals($response->error_code, '00');
    }

    public function test_fscm_checkLimit()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->checkLimit(
            'test-uuid-check-limit',
            '2021-11-18 10:18:00',
            'sigbni',
            '142',
            '7900',
            'IDR'
        );
        $this->assertEquals($response->error_code, '0000');
    }

    public function test_fscm_checkStopSupply()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->checkStopSupply(
            'test-uuid-check-stop-supply',
            'sigbni',
            '142',
            '2022-11-18 16:50:00',
            '7900',
            'IDR',
            '',
            '1'
        );
        $this->assertEquals($response->error_code, '01');
    }

    public function test_fscm_deleteInvoice()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->deleteInvoice(
            'test-uuid-delete-invoice',
            'sigbni',
            'INV_TEST111',
            '142',
            '2023-10-24 08:22:00',
            '7900'
        );
        $this->assertEquals($response->error_code, '0000');
    }

    public function test_fscm_praNota()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->praNota(
            'rq-test-pranota',
            'sigbni',
            'INVtest-201',
            '142',
            '1000000',
            'IDR',
            '17/10/2023',
            '2023-01-05 09:34:00',
            '2',
            '7900'
        );
        $this->assertEquals($response->error_code, '0000');
    }

    public function test_fscm_deletePraNota()
    {
        $bni = $this->init();
        $fscm = new FSCM($bni);
        $response = $fscm->deletePraNota(
            'rq-test-pranota',
            '2023-01-05-09:34:00',
            'sigbni',
            '142',
            '7900',
            'INVtest-201',
            '16/10/2023'
        );
        $this->assertEquals($response->error_code, '0000');
    }
}
?>