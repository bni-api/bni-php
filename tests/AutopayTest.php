<?php
namespace Tests\Unit;

use BniApi\BniPhp\api\Autopay;
use Codeception\Stub;

/**
 * Class AutopayTest
 *
 * @package Tests\Unit
 * @coversDefaultClass \BniApi\BniPhp\api\Autopay
 */
class AutopayTest extends \Codeception\Test\Unit
{
    /**
     * @var Autopay
     */
    private $autopay;

    // Success response code
    const RESP_CODE_ACCOUNT_BINDING   = '2000700';
    const RESP_CODE_ACCOUNT_UNBINDING = '2000900';
    const RESP_CODE_BALANCE_INQUIRY   = '2001100';
    const RESP_CODE_DEBIT             = '2005400';
    const RESP_CODE_DEBIT_REFUND      = '2005800';
    const RESP_CODE_DEBIT_STATUS      = '2005500';
    const RESP_CODE_LIMIT_INQUIRY     = '2000000';
    const RESP_CODE_OTP               = '2008100';
    const RESP_CODE_OTP_VERIFY        = '2000400';
    const RESP_CODE_SET_LIMIT         = '2000200';

    /**
     * Set initial value
     */
    protected function _before()
    {
        // Get credentials from ../credentials.json
        $credentials = json_decode(file_get_contents(__DIR__ . '/../credentials.json'))->autopay;

        $this->autopay = new Autopay(
            $credentials->merchantID,
            $credentials->clientID,
            $credentials->clientSecret,
            $credentials->privateKey,
            'alpha'
        );
    }

    /**
     * Not implemented yet
     */
    protected function _after(){}

    /**
     * experimental, change function to public
     */
    public function testGetSignatureToken()
    {
        $signatureToken = $this->autopay->getSignatureToken();

        $this->assertNotNull($signatureToken);
    }

    /**
     * experimental
     */
    public function testGetToken()
    {
        $accessToken = $this->autopay->getToken();

        $this->assertNotNull($accessToken);
    }

    /**
     * experimental
     */
    public function testGetSignatureService()
    {
        $signatureService = $this->autopay->getSignatureService(
            'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjbGllbnRJZCI6IjEyMzQ1NjEyMzQ1NjEyMzQ1NjEyMzQ1NjEyMzQ1NjEyMzQ1NyIsImV4cCI6MTY5MjU3OTQ2NCwianRpIjoiMjQ3ZGNhYTMtMDczNC00MjBhLTk3OTQtNzI5NDcwZjFkNDgzIiwiaWF0IjoxNjkyNTc4NTY0LCJuYmYiOjE2OTI1Nzg1NjR9.akTVobm53Ku4me6dZW3Ka4isaNKANg6RpUhfOZwx2u0',
            '/v1.0/registration-account-binding',
            []);
        
        $this->assertNotNull($signatureService);
    }

    public function testAccountBinding()
    {
        $partnerReferenceNo = '123456789009876544002';
        $bankAccountNo = '92345678902787';
        $bankCardNo = '92345678902788';
        $limit = 250000.00;
        $email = 'burhanaji2@gmail.com';
        $custIdMerchant = '92345678902788';

        $response = $this->autopay->accountBinding(
            $partnerReferenceNo,
            $bankAccountNo,
            $bankCardNo,
            $limit,
            $email,
            $custIdMerchant
        );

        codecept_debug($response);
        $this->assertEquals($response->responseCode, self::RESP_CODE_ACCOUNT_BINDING);
    }

    public function testAccountUnbinding()
    {
        $partnerReferenceNo = '12345678900987654484';
        $bankCardToken =
            'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
            'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ';
        $chargeToken = 'Xob2d8BlMxVyQRloodpujCIvuFortJ';
        $otp = '';
        $custIdMerchant = '12313213131';
        
        $response = $this->autopay->accountUnbinding(
            $partnerReferenceNo,
            $bankCardToken,
            $chargeToken,
            $otp,
            $custIdMerchant
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_ACCOUNT_UNBINDING);
    }

    public function testBalanceInquiry()
    {
        $partnerReferenceNo = '2023102899999999999902';
        $accountNo = '9234567846';
        $amount = 1000.00;
        $bankCardToken =
            'q3jcQJJTrBvYzUt2VyzY68Klw8mG400K5NWaAL5JdTbjAqjXBG9LZr' .
            '0F4khuVdrezjXFLEJRzvmF5xLZhT2fJj73FbQlf9FeqGCNW8HKSEOpzz83HYkUaQWBX2TPkaJM';

        $response = $this->autopay->balanceInquiry(
            $partnerReferenceNo,
            $accountNo,
            $amount,
            $bankCardToken
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_BALANCE_INQUIRY);
    }

    public function testDebit()
    {
        $partnerReferenceNo = '123456789009876477';
        $bankCardToken      =
            'YKYpg4xqTK1IuhlGQnrpiXHnxTcFx8ntjVfggWddVtTqsD8aUvi74oSijcVF0eV9' .
            '1zVbCganXNROsFUURUzPLWbSZp5yHKmMnijS4D2yrMeJ7yJHHTYtRHpCP2GcoXJ3';
        $chargeToken = 'ZDkLEQDZspP9FbahGkJoo3NmiSC6p0';
        $otp         = '';
        $amount      = [
            'value'    => '1000.00',
            'currency' => 'IDR'
        ];
        $remark      = 'remark';
        
        $response = $this->autopay->debit(
            $partnerReferenceNo,
            $bankCardToken,
            $chargeToken,
            $otp,
            $amount,
            $remark
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_DEBIT);
    }

    public function testDebitRefund()
    {
        $originalPartnerReferenceNo = '123456789009876408';
        $partnerRefundNo            = '223456789009876487';
        $refundAmount               = [
            'value'    => 1000.00,
            'currency' => 'IDR'
        ];
        $reason     = 'Complaint from customer';
        $refundType = 'full';// full or partial
        
        $response = $this->autopay->debitRefund(
            $originalPartnerReferenceNo,
            $partnerRefundNo,
            $refundAmount,
            $reason,
            $refundType
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_DEBIT_REFUND);
    }

    public function testDebitStatus()
    {
        $originalPartnerReferenceNo = '123456789009876408';
        $transactionDate = '20220419';
        $serviceCode       = '54'; // or 58 for refund
        $amount            = [
            'value'    => 1000.00,
            'currency' => 'IDR'
        ];
        
        $response = $this->autopay->debitStatus(
            $originalPartnerReferenceNo,
            $transactionDate,
            $serviceCode,
            $amount
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_DEBIT_STATUS);
    }

    public function testLimitInquiry()
    {
        $partnerReferenceNo = '2020102900000000000001';
        $bankCardToken      = '6d7963617264746f6b656e';
        $accountNo          = '7382382957893840';
        $amount             = 200000.00;
        
        $response = $this->autopay->limitInquiry(
            $partnerReferenceNo,
            $bankCardToken,
            $accountNo,
            $amount,
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_LIMIT_INQUIRY);
    }

    public function testOtp()
    {
        $partnerReferenceNo = '12345678900987654484';
        $journeyID          = '12345678900987654484';
        $bankCardToken      =
            'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
            'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ';
        $otpReasonCode    = '54';
        $additionalInfo   = [
            'exiperedOtp' => "2023-07-26T18:56:11+07:00",
        ];
        $externalStoreId = '134928924949479';

        $response = $this->autopay->otp(
            $partnerReferenceNo,
            $journeyID,
            $bankCardToken,
            $otpReasonCode,
            $additionalInfo,
            $externalStoreId,
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_OTP);
    }

    public function testVerifyOtp()
    {
        $originalPartnerReferenceNo = '123456789009876533';
        $originalReferenceNo        = '7979309099377000825262452054700150269920536175232508970766089901';
        $chargeToken                = 'dI7aK7aEbdgeMDnG2ygcEHQpyJQINm';
        $otp                        = '359677';

        $response = $this->autopay->verifyOtp(
            $originalPartnerReferenceNo,
            $originalReferenceNo,
            $chargeToken,
            $otp,
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_OTP_VERIFY);
    }

    public function testSetLimit()
    {
        $partnerReferenceNo = '12345678900987654484';
        $bankCardToken      =
            'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
            'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ';
        $limit              = 250000.00;
        $otp                = '898201';
        $chargeToken        = '931C5fuQgmB3FICZOag30G9p0X4Gtb';

        $response = $this->autopay->setLimit(
            $partnerReferenceNo,
            $bankCardToken,
            $limit,
            $chargeToken,
            $otp
        );

        $this->assertEquals($response->responseCode, self::RESP_CODE_SET_LIMIT);
    }
}
