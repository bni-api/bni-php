<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\SnapBI;
use BniApi\BniPhp\Bni;
use Tests\TestCase;


class SnapBITest extends TestCase
{

    public function getCredentials()
    {
        $credentials = json_decode(file_get_contents(public_path('constant.js')));
        return $credentials->snap_bi;
    }
    private function init()
    {
        return new Bni(
            $production = false,
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
            storage_path($this->getCredentials()->privateKey),
            $this->getCredentials()->channelId
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

    public function test_snapbi_balanceInquiry_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->balanceInquiry('202010290000000000002SS', '0115476117');
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2001100');
        }
    }

    public function test_snapbi_bankStatement_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->bankStatement(
                '202010290000000000002SS',
                '0115476117',
                '2010-01-01T12:08:56+07:00',
                '2011-01-01T12:08:56+07:00'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2001400');
        }
    }

    public function test_snapbi_internalAccountInquiry_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->internalAccountInquiry(
                '2020102900000000000001SS',
                '0115476151'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2001500');
        }
    }

    public function test_snapbi_transactionStatusInquiry_error()
    {
        try {
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2003600');
        }
    }

    public function test_snapbi_transfer_intraBank_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->transferIntraBank(
                '207113OO00842662SS',
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2001700');
        }
    }

    public function test_snapbi_transfer_RTGS_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->transferRTGS(
                '20220513095840015788857SS',
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2002200');
        }
    }

    public function test_snapbi_transfer_SKNBI_error()
    {
        try {
            $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->transferSKNBI(
            '20220523150428586179325SS',
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2002300');
        }
    }

    public function test_snapbi_externalaccountinquiry_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->externalAccountInquiry(
                '002',
                '888801000157508',
                '2020102900000000000001SS',
                '123456',
                'mobilephone'
            );
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2002300');
        }
    }

    public function test_snapbi_transfer_interbank_error()
    {
        try {
            $bni = $this->init();
            $snap = $this->snap($bni);
            $response = $snap->transferInterBank(
                '2022090254000000000021SS',
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
        } catch (\Throwable $e) {
            $messageArray = explode(" ", $e->getMessage());
            $responseCode = $messageArray[0];
            $this->assertNotEquals($responseCode, '2001800');
        }
    }
}
