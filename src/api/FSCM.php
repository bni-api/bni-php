<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class FSCM {
    
    protected $httpClient;
    protected $utils;
    protected $bni;
    protected $bniDirectApiKey;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    protected function requestFSCM($url, $dataJson, $data ) {
        $time = $this->utils->getTimeStamp();
        $header = [
            'X-API-Key' => $this->bni->apiKey,
            'X-Signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'X-Timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }

    public function sendInvoice(
        string $rq_uuid,
        string $password,
        string $doc_no,
        string $member_code,
        string $due_date,
        string $amount,
        string $currency,
        string $issue_date,
        string $rq_datetime,
        string $term_of_payment,
        string $comm_code,
        string $ccy,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_SEND_INVOICE . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'password' => $password,
            'doc_no' => $doc_no,
            'member_code' => $member_code,
            'due_date' => $due_date,
            'amount' => $amount,
            'currency' => $currency,
            'issue_date' => $issue_date,
            'rq_datetime' => $rq_datetime,
            'term_of_payment' => $term_of_payment,
            'comm_code' => $comm_code
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }

    public function inquiry(
        string $rq_uuid,
        string $comm_code,
        string $password,
        string $doc_no,
        string $rq_datetime,
        string $member_code
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_INQUIRY . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'comm_code' => $comm_code,
            'password' => $password,
            'doc_no' => $doc_no,
            'rq_datetime' => $rq_datetime,
            'member_code' => $member_code,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }

    public function checkTransactionPlafond(
        string $rq_uuid,
        string $comm_code,
        string $credit_type,
        string $currency,
        string $rq_datetime,
        string $member_code,
        string $amount
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_CHECK_TRANSACTION_PLAFOND . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'comm_code' => $comm_code,
            'credit_type' => $credit_type,
            'currency' => $currency,
            'rq_datetime' => $rq_datetime,
            'member_code' => $member_code,
            'amount' => $amount,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }

    public function checkLimit(
        string $rq_uuid,
        string $rq_datetime,
        string $password,
        string $member_code,
        string $comm_code,
        string $currency
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_CHECK_LIMIT . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'rq_datetime' => $rq_datetime,
            'password' => $password,
            'member_code' => $member_code,
            'comm_code' => $comm_code,
            'currency' => $currency,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }
    
    public function checkStopSupply(
        string $rq_uuid,
        string $password,
        string $member_code,
        string $rq_datetime,
        string $comm_code,
        string $currency,
        string $ccy,
        string $status_member
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_CHECK_STOP_SUPPLY . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'password' => $password,
            'member_code' => $member_code,
            'rq_datetime' => $rq_datetime,
            'comm_code' => $comm_code,
            'currency' => $currency,
            'ccy' => $ccy,
            'status_member' => $status_member
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }

    public function deleteInvoice(
        string $rq_uuid,
        string $password,
        string $doc_no,
        string $member_code,
        string $rq_datetime,
        string $comm_code
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_DELETE_INVOICE . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'password' => $password,
            'doc_no' => $doc_no,
            'member_code' => $member_code,
            'rq_datetime' => $rq_datetime,
            'comm_code' => $comm_code,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }
    
    public function praNota(
        string $rq_uuid,
        string $password,
        string $doc_no,
        string $member_code,
        string $amount,
        string $currency,
        string $issue_date,
        string $rq_datetime,
        string $term_of_payment,
        string $comm_code
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_PRA_NOTA . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'password' => $password,
            'doc_no' => $doc_no,
            'member_code' => $member_code,
            'amount' => $amount,
            'currency' => $currency,
            'issue_date' => $issue_date,
            'rq_datetime' => $rq_datetime,
            'term_of_payment' => $term_of_payment,
            'comm_code' => $comm_code,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }

    public function deletePraNota(
        string $rq_uuid,
        string $password,
        string $doc_no,
        string $member_code,
        string $rq_datetime,
        string $comm_code
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_FSCM_DELETE_PRA_NOTA . '?access_token=' . $this->bni->getToken();
        $data = [
            'rq_uuid' => $rq_uuid,
            'password' => $password,
            'doc_no' => $doc_no,
            'member_code' => $member_code,
            'rq_datetime' => $rq_datetime,
            'comm_code' => $comm_code,
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestFSCM($url, $dataJson, $data );
        
        return Response::FSCM($response);
    }
}
 ?>