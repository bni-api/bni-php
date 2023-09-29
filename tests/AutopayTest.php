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
     * @skip
     */
    public function testGetSignatureToken()
    {
        $signatureToken = $this->autopay->getSignatureToken();

        codecept_debug($signatureToken);

        $this->assertNotNull($signatureToken);
    }

    /**
     * experimental
     * @skip
     */
    public function testGetToken()
    {
        $accessToken = $this->autopay->getToken();

        codecept_debug($accessToken);

        $this->assertNotNull($accessToken);
    }

    /**
     * experimental
     * @skip
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
        $partnerReferenceNo = '123456789009876544011';
        $bankAccountNo = '9234567890';
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
        $partnerReferenceNo = '8412442037020809301266044471028449546314372628686173676019995122';
        $bankCardToken =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';
        $chargeToken = 'qsUv9eFPysSwz5m3alrn1j9Hba3nbY';
        $otp = '631990';
        $custIdMerchant = '12313213131';
        
        $response = $this->autopay->accountUnbinding(
            $partnerReferenceNo,
            $bankCardToken,
            $chargeToken,
            $otp,
            $custIdMerchant
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_ACCOUNT_UNBINDING);
    }

    public function testBalanceInquiry()
    {
        $partnerReferenceNo = '2023102899999992999902';
        $accountNo = '9234567890';
        $amount = 1000.00;
        $bankCardToken =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';

        $response = $this->autopay->balanceInquiry(
            $partnerReferenceNo,
            $accountNo,
            $amount,
            $bankCardToken
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_BALANCE_INQUIRY);
    }

    public function testDebit()
    {
        $partnerReferenceNo = '2023102899999999999964';
        $bankCardToken      =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';
        $chargeToken = 'riZv2AfElsJqRVwYWYTzU3AVddI0qg';
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
        $originalPartnerReferenceNo = '2023102899999999999964';
        $partnerRefundNo            = '2023102899999999991889';
        $refundAmount               = [
            'value'    => 200.00,
            'currency' => 'IDR'
        ];
        $reason     = 'Complaint from customer';
        $refundType = 'partial';// full or partial
        
        $response = $this->autopay->debitRefund(
            $originalPartnerReferenceNo,
            $partnerRefundNo,
            $refundAmount,
            $reason,
            $refundType
        );
        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_DEBIT_REFUND);
    }

    public function testDebitStatus()
    {
        $originalPartnerReferenceNo = '2023102899999999999964';
        $transactionDate = date('Ymd');
        $serviceCode       = '58'; // or 58 for refund
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

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_DEBIT_STATUS);
    }

    public function testLimitInquiry()
    {
        $partnerReferenceNo = '2020102900000000200001';
        $bankCardToken      =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';
        $accountNo          = '9234567890';
        $amount             = 200000.00;
        
        $response = $this->autopay->limitInquiry(
            $partnerReferenceNo,
            $bankCardToken,
            $accountNo,
            $amount,
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_LIMIT_INQUIRY);
    }

    public function testOtp()
    {
        $partnerReferenceNo = '2023102899929999999222';
        $journeyID          = '12345678100987651198';
        $bankCardToken      =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';
        $otpReasonCode    = '09';
        $additionalInfo   = [
            'expiredOtp' => date('c', strtotime('+300 seconds')),
        ];
        $externalStoreId = '134928924942479';

        $this->autopay->setHeader('externalID', $journeyID);

        $response = $this->autopay->otp(
            $partnerReferenceNo,
            $journeyID,
            $bankCardToken,
            $otpReasonCode,
            $additionalInfo,
            $externalStoreId,
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_OTP);
    }

    public function testVerifyOtp()
    {
        $originalPartnerReferenceNo = '123456789009876544011';
        $originalReferenceNo        = '8412442037020809301266044471028449546314372628686173676019995137';
        $chargeToken                = 'pYtWBW9MjYFL8KlGkzTv5Wv8dqnCKa';
        $otp                        = '178128';

        $response = $this->autopay->verifyOtp(
            $originalPartnerReferenceNo,
            $originalReferenceNo,
            $chargeToken,
            $otp,
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_OTP_VERIFY);
    }

    public function testSetLimit()
    {
        $partnerReferenceNo = '2023102899929999999964';
        $bankCardToken      =
            'xrk3L9uuxz9RPYaKjXGK7dQpD1jeUzYIHfb3mTrMQ8Eplpautpv9hm2C53a0191PuUcgTQBlkI' .
            'RO8Y4Vnd98ITSSsi55EUJmf95qwbkNXqH9S4sndznG6HtZNa6mHg31';
        $limit              = 500000.00;
        $otp                = '708625';
        $chargeToken        = 'DAoMiuvkljcQ0u9r7qgaRsfl2ADppa';

        $response = $this->autopay->setLimit(
            $partnerReferenceNo,
            $bankCardToken,
            $limit,
            $chargeToken,
            $otp
        );

        codecept_debug($response);

        $this->assertEquals($response->responseCode, self::RESP_CODE_SET_LIMIT);
    }
}
