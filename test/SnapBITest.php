<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\SnapBI;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;


class SnapBITest extends TestCase
{

    public function getCredentials()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return $credentials->snap_bi;
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

    public function snap(Bni $bni)
    {
        return new SnapBI(
            $bni,
            __DIR__ . '/' . $this->getCredentials()->privateKey,
            $this->getCredentials()->channelId
        );
    }

    public function test_snapbi_balanceInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->balanceInquiry(
            '202010290000000000002', 
            '0115476117'
        );
        $this->assertEquals($response->responseCode, '2001100');
    }

    public function test_snapbi_internalAccountInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->internalAccountInquiry(
            '2023062601000000000509',
            '317125693'
        );
        $this->assertEquals($response->responseCode, '2001500');
    }

    public function test_snapbi_transactionStatusInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transactionStatusInquiry(
            '2022051314142684054947620220513141426840549476',
            '',
            '',
            '22',
            '',
            '100000001.00',
            'IDR',
            '09864ADCASA',
            'API'
        );
        $this->assertEquals($response->responseCode, '2003600');
    }

    public function test_snapbi_transfer_intraBank()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferIntraBank(
            '20220426170737356898',
            '55000.00',
            'IDR',
            '0115476151',
            '',
            'IDR',
            '20220426170737356898',
            'OUR',
            '20220426170737356898',
            '0115476117',
            '2022-04-26T17:07:36+07:00',
            '',
            ''
        );
        $this->assertEquals($response->responseCode, '2001700');
    }

    public function test_snapbi_transfer_RTGS()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferRTGS(
            '20220513095840015788857',
            '100000001.00',
            'IDR',
            'PTXYZIndonesia',
            '3333333333',
            'JlGatotSubrotoNoKav18RW1KuninganBarKecMampangPrptKotaJakartaSelatanDaerahKhususIbukotaJakarta12710',
            'CENAIDJA',
            'PTBANKCENTRALASIATbk',
            '1',
            '2',
            '-',
            'IDR',
            '20220513095840015788857',
            'OUR',
            '-',
            '-',
            'DANA20220513095840015788857PTZomatoMediaIndonesia',
            '-',
            '-',
            '-',
            '0115476151',
            '2020-06-17T01:03:04+07:00',
            '',
            ''
        );
        $this->assertEquals($response->responseCode, '2002200');
    }

    public function test_snapbi_transfer_SKNBI()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferSKNBI(
            '2022101829912160579817066466',
            '120000000.00',
            'IDR',
            'Trinawati Eka Putri',
            '0115476117',
            'Palembang',
            'CENAIDJAXXX',
            'PT. BANK CENTRAL ASIA Tbk.',
            '1',
            '1',
            'xyz@xyz.co.id',
            'IDR',
            '56756567567',
            'BEN',
            '',
            '',
            'remark test',
            '',
            '',
            '',
            '0115476151',
            '2022-10-18T09:44:44+07:00',
            'Biaya Hidup Pihak Asing',
            '01'
        );
        $this->assertEquals($response->responseCode, '2002300');
    }

    public function test_snapbi_externalaccountinquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->externalAccountInquiry(
            '123456789',
            '20240226163135663',
            'CENAIDJAXXX',
            '09864ADCASA',
            'API'
        );
        $this->assertEquals($response->responseCode, '2001600');
    }

    public function test_snapbi_transfer_interbank()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferInterBank(
            '20240226163731861',
            '20000',
            'IDR',
            'SRI ANGGRAINI',
            '0000000986',
            'Palembang',
            '014',
            'Bank BCA',
            'customertes@outlook',
            'IDR',
            '20231219085',
            '1000161562',
            '2024-01-04T08:37:08+07:00',
            'OUR',
            '09864ADCASA',
            'API'
        );
        $this->assertEquals($response->responseCode, '2001800');
    }
}
