<?php

namespace BniApi\BniPhp\test;

use Tests\TestCase;
use BniApi\BniPhp\api\SnapBI;
use BniApi\BniPhp\Bni;

class SnapBITest extends TestCase
{

    private function init()
    {
        return new Bni(
            false,
            'Test Wawat',
            '0bed55cb-c25d-4f07-9c5f-78f7c8aac9da',
            '46987047-6d56-410d-b43c-abdd247abac2',
            '91ea86f6-387a-49f9-bc55-670e4d2ef67b',
            'cc914c89-6b65-475d-a450-58ee4199a1b2'
        );
    }

    public function snap(Bni $bni)
    {
        return new SnapBI(
            $bni,
            storage_path('private.key'),
            '95221'
        );
    }

    public function test_snapbi_balanceInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->balanceInquiry('202010290000000000002', '0115476117');
        $this->assertEquals($response->responseCode, '2001100');
    }

    public function test_snapbi_bankStatement()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->bankStatement(
            '202010290000000000002',
            '0115476117',
            '2010-01-01T12:08:56+07:00',
            '2011-01-01T12:08:56+07:00'
        );
        $this->assertEquals($response->responseCode, '2001400');
    }

    public function test_snapbi_internalAccountInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->internalAccountInquiry(
            '2020102900000000000001',
            '0115476151'
        );
        $this->assertEquals($response->responseCode, '2001500');
    }

    public function test_snapbi_transactionStatusInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transactionStatusInquiry(
            '202201911020000121',
            '220531103343739748',
            '20220531103340',
            '17',
            '2022-05-31',
            '15000.00',
            'IDR',
            '123456',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2003600');
    }

    public function test_snapbi_transfer_intraBank()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferIntraBank(
            '207113OO00842662',
            '500000.00',
            'IDR',
            '1000161562',
            '',
            'IDR',
            '207113OO00842662',
            'OUR',
            'DANA20220426170737356898YuliantoSariputra',
            '1000164314',
            '2022-09-05T10:29:57+07:00',
            '123456',
            'mobilephone'
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
            'PTZomatoMediaIndonesia',
            '3333333333',
            'JlGatotSubrotoNoKav18RW1KuninganBarKecMampangPrptKotaJakartaSelatanDaerahKhususIbukotaJakarta12710',
            'CENAIDJA',
            'PTBANKCENTRALASIATbk',
            '1',
            '2',
            '',
            'IDR',
            '20220513095840015788857',
            'OUR',
            '12550',
            '',
            'Already One Year',
            '1',
            '1',
            '',
            '0115476151',
            '2020-06-17T01:03:04+07:00',
            '123456',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2002200');
    }

    public function test_snapbi_transfer_SKNBI()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferSKNBI(
            '20220523150428586179325',
            '10000001.00',
            'IDR',
            'PTZomatoMediaIndonesia',
            '0115476117',
            'JlGatotSubrotoNoKav18RW1KuninganBarKecMampangPrptKotaJakartaSelatanDaerahKhususIbukotaJakarta12710',
            'CENAIDJAXXX',
            'PT. BANK CENTRAL ASIA Tbk.',
            '1',
            '2',
            '',
            'IDR',
            '20220523150428586179325',
            'OUR',
            '12550',
            '',
            'Already One Year',
            '1',
            '1',
            '',
            '0115476151',
            '2020-06-17T01:03:04+07:00',
            '123456',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2002300');
    }

    public function test_snapbi_externalaccountinquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->externalAccountInquiry(
            '002',
            '888801000157508',
            '2020102900000000000001',
            '123456',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2001600');
    }

    public function test_snapbi_transfer_interbank()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferInterBank(
            '2022090254000000000021',
            '55000',
            'IDR',
            'BONIFASIUSPRIOKO',
            '3333333333',
            'Palembang',
            '014',
            'BCA',
            'yories.yolanda@work.bri.co.id',
            'IDR',
            '10052025',
            '0115476151',
            '2022-06-14T12:08:56+07:00',
            'OUR',
            '12345679237',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2001800');
    }
}
