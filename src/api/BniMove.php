<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class BniMove
{

    protected $bni;
    private $httpClient;
    private $utils;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    private function requestBniMove($url, $data, $dataJson)
    {
        $time = $this->utils->getTimeStampBniMove();
        $header = [
            'x-api-key' => $this->bni->apiKey,
            'x-signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'x-timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }

    public function prescreening(
        string $kodeMitra,
        string $npp,
        string $namaLengkapKtp,
        string $noKtp,
        string $noHandphone,
        string $alamatUsaha,
        string $provinsiUsaha,
        string $kotaUsaha,
        string $kecamatanUsaha,
        string $kelurahanUsaha,
        string $kodePosUsaha,
        string $sektorEkonomi,
        float $totalPenjualan,
        string $jangkaWaktu,
        string $jenisPinjaman,
        float $maximumKredit,
        int $jenisKelamin,
        string $tanggalLahir,
        string $subSektorEkonomi,
        string $deskripsi,
        string $email,

    )
    {
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_MOVE_PRESCREENING . '?access_token=' . $this->bni->getToken();
        $data = [
            'kodeMitra' => $kodeMitra,
            'npp' => $npp,
            'namaLengkapKtp' => $namaLengkapKtp,
            'noKtp' => $noKtp,
            'noHandphone' => $noHandphone,
            'alamatUsaha' => $alamatUsaha,
            'provinsiUsaha' => $provinsiUsaha,
            'kotaUsaha' => $kotaUsaha,
            'kecamatanUsaha' => $kecamatanUsaha,
            'kelurahanUsaha' => $kelurahanUsaha,
            'kodePosUsaha' => $kodePosUsaha,
            'sektorEkonomi' => $sektorEkonomi,
            'totalPenjualan' => $totalPenjualan,
            'jangkaWaktu' => $jangkaWaktu,
            'jenisPinjaman' => $jenisPinjaman,
            'maximumKredit' => $maximumKredit,
            'jenisKelamin' => $jenisKelamin,
            'tanggalLahir' => $tanggalLahir,
            'subSektorEkonomi' => $subSektorEkonomi,
            'deskripsi' => $deskripsi,
            'email' => $email
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];

        $response = $this->requestBniMove($url, $data, $dataJson);

        return Response::BniMove($response);
    }

    public function saveImage(
        string $Id,
        string $deskripsi,
        string $jenisDokumen,
        string $namaFile,
        string $extensionFile,
        string $dataBase64
    )
    {
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_MOVE_SAVE_IMAGE . '?access_token=' . $this->bni->getToken();

        $data = [
            'Id' => $Id,
            'deskripsi' => $deskripsi,
            'jenisDokumen' => $jenisDokumen,
            'namaFile' => $namaFile,
            'extensionFile' => $extensionFile,
            'dataBase64' => $dataBase64,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];

        $response = $this->requestBniMove($url, $data, $dataJson);

        return Response::BniMove($response);
    }

}
