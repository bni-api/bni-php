<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;
use stdClass;

/**
 * Autopay class helps making all request to BNI Autopay SNAP API
 *
 * @version 0.1.0
 */
class Autopay
{
    public $httpClient;
    public $utils;
    public $bni;

    const ENV_ALPHA = 'alpha';
    const ENV_BETA   = 'beta';
    const ENV_PROD  = 'prod';

    private $baseUrl;

    // header for request
    private $origin     = 'www.spesandbox.com';
    private $ipAddress  = '127.0.0.1';
    private $channelId  = '';
    private $latitude   = '';
    private $longitude  = '';
    private $externalID = '';

    // merchant credentials
    private string $merchantID   = '';
    private string $clientID     = '';
    private string $clientSecret = '';
    private string $privateKey   = '';

    /**
     * Autopay constructor
     */
    public function __construct(
        string $merchantID   = '',
        string $clientID     = '',
        string $clientSecret = '',
        string $privateKey   = '',
        string $env          = self::ENV_ALPHA
    ) {
        $this->utils = new Util;
        $this->httpClient = new HttpClient;

        // merchant credentials
        $this->merchantID   = $merchantID;
        $this->clientID     = $clientID;
        $this->clientSecret = $clientSecret;
        $this->privateKey   = $privateKey;
        $this->channelId    = $this->utils->randomString(5);

        switch ($env) {
            case self::ENV_PROD:
                $this->baseUrl = 'https://api-snap-autopay.bni-ecollection.com';
                break;
            
            case self::ENV_BETA:
                $this->baseUrl = 'https://api-uat-autopay.bni-ecollection.com';
                break;
            
            case self::ENV_ALPHA:
            default:
                $this->baseUrl = 'https://api-alpha-autopay.bni-ecollection.com';
                break;
        }
    }

    /**
     * Set a header value
     *
     * @param string $header header name
     * @param string $value header value
     */
    public function setHeader($header, $value)
    {
        $this->$header = $value;
    }

    /**
     * Generate signature token
     *
     * @param string $timestamp timestamp (date(c))
     * @return string signature token
     */
    private function getSignatureToken($timestamp = '')
    {
        return $this->utils->generateSignatureAccessToken(
            $this->clientID,
            $this->privateKey,
            $timestamp
        );
    }

    /**
     * Hit API to get access token
     *
     * @return string access token
     */
    public function getToken()
    {
        $timestamp            = $this->utils->getTimeStamp();
        $url                  = $this->baseUrl . Constant::URL_AUTOPAY_ACCESS_TOKEN_B2B;
        $signatureAccessToken = $this->getSignatureToken($timestamp);

        $header = [
            'X-CLIENT-KEY' => $this->clientID,
            'X-TIMESTAMP'  => $timestamp,
            'X-SIGNATURE'  => $signatureAccessToken,
            'X-DEVICE-ID'  => 'bni-php/0.1.0',
        ];

        $body = [
            RequestOptions::JSON => ['grantType' => 'client_credentials']
        ];

        $response = $this->httpClient->request('POST', $url, $header, $body);
        
        return json_decode($response->getBody())->accessToken;
    }

    /**
     * Generate signature service
     *
     * @param string $token access token from getToken()
     * @param string $serviceUrl URL endpoint, @see Constant.php with URL_AUTOPAY prefix
     * @param array $data request body
     * @return string signature service
     */
    private function getSignatureService($token = '', $serviceUrl = '', $data = [])
    {
        return $this->utils->generateSignatureService(
            'POST',
            $data,
            $serviceUrl,
            $token,
            $this->utils->getTimeStamp(),
            $this->clientSecret
        );
    }

    /**
     * Send request to specific endpoint
     *
     * @param string $url URL endpoint, @see Constant.php with URL_AUTOPAY prefix
     * @param string $token access token from getToken()
     * @param array $data request body
     * @param string $timeStamp timestamp from utils getTimeStamp()
     * @return GuzzleHttp\Psr7\Response
     */
    private function sendRequest(string $url, string $token, array $data, string $timeStamp)
    {
        $signature = $this->getSignatureService($token, $url, $data);

        $externalID = $this->externalID ? $this->externalID : $this->utils->randomNumber();

        $header = [
            'Content-Type: application/json',
            'Authorization' => 'Bearer ' . $token,
            'X-TIMESTAMP'   => $timeStamp,
            'X-SIGNATURE'   => $signature,
            'ORIGIN'        => $this->origin,
            'X-PARTNER-ID'  => $this->merchantID,
            'X-IP-ADDRESS'  => $this->ipAddress,
            'X-DEVICE-ID'   => 'bni-php/0.1.0',
            'X-EXTERNAL-ID' => $externalID,
            'CHANNEL-ID'    => $this->channelId,
            'X-LATITUDE'    => $this->latitude,
            'X-LONGITUDE'   => $this->longitude
        ];

        // set URL
        $url = $this->baseUrl . $url;

        $body = [
            RequestOptions::JSON => $data
        ];

        return $this->httpClient->request('POST', $url, $header, $body);
    }

    /**
     * Account Binding (Register a bank account number to a specific merchant)
     * most likely will be followed by the OTP verification
     *
     * @param string $partnerReferenceNo unique identifier for each request
     * @param string $bankAccountNo 10-11 digits of bank account number
     * @param string $bankCardNo 16 digit of bank card number
     * @param float $limit should be greater than 0
     * @param string $email
     * @param string $custIdMerchant optional
     * @return Object
     */
    public function accountBinding(
        string $partnerReferenceNo,
        string $bankAccountNo,
        string $bankCardNo,
        float $limit = 1,
        string $email = '',
        string $custIdMerchant = ''
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        // validate limit, should be greater than 0
        if ($limit <= 0) {
            throw new \InvalidArgumentException('limit should be greater than 0');
        }

        $limit = $this->utils->formatAmount($limit);

        $data = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'merchantId' => $this->merchantID,
            'additionalData' => [
                'bankAccountNo' => $bankAccountNo,
                'bankCardNo'    => $bankCardNo,
                'limit'         => (string) $limit,
                'email'         => $email
            ],
            'additionalInfo' => [
                'custIdMerchant' => $custIdMerchant
            ]
        ];

        $response = $this->sendRequest(Constant::URL_AUTOPAY_ACCOUNT_BINDING, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Account Unbinding (Unregister a bank account number from a merchant)
     * most likely be preceded by the OTP API
     *
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @param string $chargeToken unique string identifier, as a response from OTP API
     * @param string $otp 6 digits of OTP code
     * @param string $custIdMerchant optional
     * @return Object
     */
    public function accountUnbinding(
        string $partnerReferenceNo,
        string $bankCardToken,
        string $chargeToken,
        string $otp,
        string $custIdMerchant = ''
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        $data = [
            'merchantId'         => $this->merchantID,
            'partnerReferenceNo' => $partnerReferenceNo,
            'otp'                => $otp,
            'bankCardToken'      => $bankCardToken,
            'chargeToken'        => $chargeToken,
            'additionalInfo' => [
                'custIdMerchant' => $custIdMerchant
            ]
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_ACCOUNT_UNBINDING, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Balance Inquiry (Check if the balance of a bank account is sufficient for a transaction)
     *
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $accountNo 10-11 digits of bank account number
     * @param float $amount transaction amount in float
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @return Object
     */
    public function balanceInquiry(
        string $partnerReferenceNo,
        string $accountNo,
        float $amount,
        string $bankCardToken
    )
    {
        $timeStamp = $this->utils->getTimeStamp();
        $token = $this->getToken();

        $amount = $this->utils->formatAmount($amount);

        $data = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'accountNo'          => $accountNo,
            'additionalInfo' => [
                'amount' => (string) $amount,
            ],
            'bankCardToken' => $bankCardToken
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_BALANCE_INQUIRY, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Debit (Direct Debit / doing a transaction using the VA)
     *
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @param string $chargeToken unique string identifier, as a response from OTP API
     * @param string $otp 6 digits of OTP code
     * @param array $amount detail of an amount, should consist of `value` and `currency`
     * @param string $remark optional additional data
     * @return Object
     */
    public function debit(
        string $partnerReferenceNo,
        string $bankCardToken,
        string $chargeToken,
        string $otp = '',
        array $amount = ['value' => 0.00, 'currency' => 'IDR'],
        string $remark = ''
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        $data = [
            'merchantId'         => $this->merchantID,
            'partnerReferenceNo' => $partnerReferenceNo,
            'bankCardToken'      => $bankCardToken,
            'chargeToken'        => $chargeToken,
            'otp'                => $otp,
            'amount'             => [
                'value'    => (string) $amount['value'],
                'currency' => $amount['currency']
            ],
            'remark'             => $remark,
            'additionalInfo'     => new stdClass()
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_DEBIT, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Debit Refund (Refund a transaction)
     *
     * @param string $originalPartnerReferenceNo refers to partnerReferenceNo on Debit API
     * @param string $partnerRefundNo unique identifier string (max 64 chars)
     * @param array $refundAmount detail of an amount, should consist of `value` and `currency`
     * @param string $reason reason of the refund
     * @param string $refundType `full` or `partial`
     * @return Object
     */
    public function debitRefund(
        string $originalPartnerReferenceNo,
        string $partnerRefundNo,
        array $refundAmount = ['value' => 0.00, 'currency' => 'IDR'],
        string $reason = '',
        string $refundType = 'full'
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        if (!in_array($refundType, ['full', 'partial'])) {
            throw new \InvalidArgumentException('refundType should be full or partial');
        }

        if (!array_key_exists('value', $refundAmount) || !array_key_exists('currency', $refundAmount)) {
            throw new \InvalidArgumentException('refundAmount should contain key value and currency');
        }

        $data = [
            'merchantId'                 => $this->merchantID,
            'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
            'partnerRefundNo'            => $partnerRefundNo,
            'refundAmount'               => [
                'value'    => (string) $this->utils->formatAmount($refundAmount['value']),
                'currency' => $refundAmount['currency']
            ],
            'reason'         => $reason,
            'additionalInfo' => [
                'type' => $refundType
            ]
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_DEBIT_REFUND, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Debit Status (get the status of a transaction or refund)
     *
     * @param string $originalPartnerReferenceNo refers to partnerReferenceNo on Debit API
     * @param string $transactionDate date of the transaction in YYYYMMDD format
     * @param string $serviceCode 54 for Debit, 58 for Refund
     * @param array $amount detail of an amount, should consist of value and currency
     * @return Object
     */
    public function debitStatus(
        string $originalPartnerReferenceNo,
        string $transactionDate,
        string $serviceCode = '54',
        array $amount = ['value' => 0.00, 'currency' => 'IDR']
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();
        $data = [
            'merchantId'                 => $this->merchantID,
            'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
            'transactionDate'            => $transactionDate,
            'serviceCode'                => $serviceCode,
            'amount'                     => [
                'value'    => (string) $this->utils->formatAmount($amount['value']),
                'currency' => $amount['currency']
            ],
            'additionalInfo'             => new stdClass()
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_DEBIT_STATUS, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Limit Inquiry (Check remaining daily amount limit)
     *
     * @param string $accountNo 10-11 digits of bank account number
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @param float $amount transaction amount in float
     * @return Object
     */
    public function limitInquiry(
        string $accountNo,
        string $partnerReferenceNo,
        string $bankCardToken,
        float $amount = 0.00
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        $data = [
            'accountNo'          => $accountNo,
            'partnerReferenceNo' => $partnerReferenceNo,
            'bankCardToken'      => $bankCardToken,
            'additionalInfo'     => [
                'amount' => (string) $amount
            ]
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_LIMIT_INQUIRY, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * OTP (Send an OTP code to customer)
     *
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $journeyID 36 chars of unique identifier, should be the same as X-EXTERNAL-ID
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @param string $otpReasonCode 02 | 09 | 53 | 54 (default)
     * @param array $additionalInfo ['expiredOtp' => date(DateTime::ATOM)]
     * @param string $externalStoreId external Store identifier
     * @return Object
     */
    public function otp(
        string $partnerReferenceNo,
        string $journeyID,
        string $bankCardToken,
        string $otpReasonCode = '54',
        array $additionalInfo = ['expiredOtp' => ''],
        string $externalStoreId = ''
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        // set otpReasonMessage based on otpReasonCode (also minimize the number of func arguments)
        switch ($otpReasonCode) {
            case '02':
                $otpReasonMessage = 'Card Registration Set Limit';
                break;
            
            case '09':
                $otpReasonMessage = 'Account Unbinding';
                break;
            
            case '53':
                $otpReasonMessage = 'Force Debit';
                break;
            
            case '54':
                $otpReasonMessage = 'Direct Debit';
                break;

            default:
                throw new \InvalidArgumentException('otpReasonCode should be 02, 09, 53, or 54');
                break;
        }

        $data = [
            'merchantId'         => $this->merchantID,
            'partnerReferenceNo' => $partnerReferenceNo,
            'journeyID'          => $journeyID,
            'bankCardToken'      => $bankCardToken,
            'otpReasonCode'      => $otpReasonCode,
            'otpReasonMessage'   => $otpReasonMessage,
            'additionalInfo'     => $additionalInfo,
            'externalStoreId'    => $externalStoreId
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_OTP, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Verify an OTP code
     *
     * @param string $originalPartnerReferenceNo refers to partnerReferenceNo on previous API
     * @param string $originalReferenceNo refers to referenceNo on previous API's additionalInfo
     * @param string $chargeToken unique string identifier, as a response from previous API
     * @param string $otp 6 digits of OTP code
     * @return Object
     */
    public function verifyOtp(
        string $originalPartnerReferenceNo,
        string $originalReferenceNo,
        string $chargeToken,
        string $otp
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        $data = [
            'merchantId'                 => $this->merchantID,
            'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
            'originalReferenceNo'        => $originalReferenceNo,
            'chargeToken'                => $chargeToken,
            'otp'                        => $otp,
            'additionalInfo'             => new stdClass() // wth
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_OTP_VERIFY, $token, $data, $timeStamp);
        return Response::autopay($response);
    }

    /**
     * Set Limit (Set daily limit for an account)
     *
     * @param string $partnerReferenceNo unique identifier string (max 64 chars)
     * @param string $bankCardToken unique customer identifier, generated when hit account binding API
     * @param float $limit should be greater than 0
     * @param string $chargeToken unique string identifier, as a response from previous API
     * @param string $otp 6 digits of OTP code
     * @return Object
     */
    public function setLimit(
        string $partnerReferenceNo,
        string $bankCardToken,
        float  $limit          = 0.00,
        string $chargeToken    = '',
        string $otp            = ''
    )
    {
        $token = $this->getToken();
        $timeStamp = $this->utils->getTimeStamp();

        // validate limit, should be greater than 0
        if ($limit <= 0) {
            throw new \InvalidArgumentException('limit should be greater than 0');
        }

        $limit = $this->utils->formatAmount($limit);

        $data = [
            'partnerReferenceNo' => $partnerReferenceNo,
            'bankCardToken'      => $bankCardToken,
            'limit'              => (string) $limit,
            'otp'                => $otp,
            'additionalInfo'     => [
                'chargeToken' => $chargeToken,
                'merchantId'  => $this->merchantID
            ]
        ];
        
        $response = $this->sendRequest(Constant::URL_AUTOPAY_SET_LIMIT, $token, $data, $timeStamp);
        return Response::autopay($response);
    }
}
