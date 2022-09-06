<?php

namespace Wawatprigala\BniPhp\test;

use Tests\TestCase;
use Wawatprigala\BniPhp\api\SnapBI;
use Wawatprigala\BniPhp\Bni;

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
            '95051'
        );
    }

    public function test_snapbi_balanceInquiry()
    {
        $bni = $this->init();
        $snap = $this->snap($bni);
        $response = $snap->balanceInquiry('202010290000000000002', '0115476117');
        $this->assertEquals($response->responseCode,'2000000');
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
        $this->assertEquals($response->responseCode,'2001400');
    }


}
