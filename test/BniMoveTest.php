<?php

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\BniMove;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class BniMoveTest extends TestCase
{

    private function init()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new Bni(
            $env = 'sandbox',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName
        );
    }

    public function test_bni_move_prescreening()
    {
        $bni = $this->init();
        $bniMove = new BniMove($bni);
        $response = $bniMove->prescreening(
            $kodeMitra = 'BNI',
            $npp = '',
            $namaLengkapKtp = 'Muhammad Haikal Madani',
            $noKtp = '3174052209980002',
            $noHandphone = '085921658045',
            $alamatUsaha = 'jakarta',
            $provinsiUsaha = '06',
            $kotaUsaha = '143',
            $kecamatanUsaha = '1074',
            $kelurahanUsaha = '4254',
            $kodePosUsaha = '11450',
            $sektorEkonomi = '2',
            $totalPenjualan = 50000000,
            $jangkaWaktu = '12',
            $jenisPinjaman = '1',
            $maximumKredit = 50000000,
            $jenisKelamin = '1',
            $tanggalLahir = '1998-10-07',
            $subSektorEkonomi = '050111',
            $deskripsi = 'Usaha Ternak Perikanan',
            $Email = 'muhammadhaikalmadani@mail.com'
        );
        $this->assertEquals($response->statusCode, '0');
    }

    public function test_digiloan_save_image()
    {
        $bni = $this->init();
        $bniMove = new BniMove($bni);
        $response = $bniMove->saveImage(
            $Id = 'MJO2024022000004',
            $deskripsi = 'Foto Identitas KTP',
            $jenisDokumen = 'A03',
            $namaFile = 'Foto KTP',
            $extensionFile = 'png',
            $dataBase64 = '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'
        );
        $this->assertEquals($response->statusCode, '0');
    }

}
