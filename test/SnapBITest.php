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
            $env = 'uat',
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
        $response = $snap->balanceInquiry('202010290000000000002', '0115476117');
        $this->assertEquals($response->responseCode, '2001100');
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
            '20211213100434',
            '20211220141520',
            '20211220141520',
            '36',
            '2021-12-20',
            '12500.00',
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
            '202201911020300006',
            '125000.00',
            'IDR',
            '0115476117',
            '',
            'IDR',
            '14045',
            '',
            'Already One Year',
            '0115476151',
            '2021-12-13',
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
            '202201911020300011',
            '150005001',
            'IDR',
            'SAN',
            '3333333333',
            'Jakarta Barat',
            'CENAIDJA',
            'PT. BANK CENTRAL ASIA Tbk.',
            '1',
            '1',
            '',
            'IDR',
            '202201911020300006',
            'OUR',
            '12550',
            '',
            'Already One Year',
            '1',
            '1',
            '',
            '0115476151',
            '2022-01-25',
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
            '202201911020300012',
            '150005001',
            'IDR',
            'SAN',
            '3333333333',
            'Jakarta Barat',
            '0140397',
            'PT. BANK CENTRAL ASIA Tbk.',
            '1',
            '1',
            '',
            'IDR',
            '202201911020300006',
            'OUR',
            '12550',
            '',
            'Already One Year',
            '1',
            '1',
            '',
            '0115476151',
            '2022-01-25',
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
            '2020102900000000000001',
            '12345678.00',
            'IDR',
            'Yories Yolanda',
            '888801000003301',
            'Palembang',
            '002',
            'Bank BRI',
            'yories.yolanda@work.bri.co.id',
            'IDR',
            '10052019',
            '888801000157508',
            '2019-07-03T12:08:56-07:00',
            'OUR',
            '12345679237',
            'mobilephone'
        );
        $this->assertEquals($response->responseCode, '2001800');
    }
}
