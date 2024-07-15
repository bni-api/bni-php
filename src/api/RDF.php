<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use BniApi\BniPhp\utils\Util;
use GuzzleHttp\RequestOptions;

class RDF
{
    protected $bni;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    private function requestRDF($url, $dataJson, $data ) {
        $time = $this->utils->getTimeStamp();
        $header = [
            'X-API-Key' => $this->bni->apiKey,
            'X-Signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'X-Timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }

    public function registerInvestor(
        string $companyId,
        string $parentCompanyId,
        string $uuidFaceRecog,
        string $title,
        string $firstName,
        string $middleName,
        string $lastName,
        string $optNPWP,
        string $NPWPNum,
        string $nationality,
        string $domicileCountry,
        string $religion,
        string $birthPlace,
        string $birthDate,
        string $gender,
        string $isMarried,
        string $motherMaidenName,
        string $jobCode,
        string $education,
        string $idType,
        string $idNumber,
        string $idIssuingCity,
        string $idExpiryDate,
        string $addressStreet,
        string $addressRtRwPerum,
        string $addressKel,
        string $addressKec,
        string $zipCode,
        string $homePhone1,
        string $homePhone2,
        string $officePhone1,
        string $officePhone2,
        string $mobilePhone1,
        string $mobilePhone2,
        string $faxNum1,
        string $faxNum2,
        string $email,
        string $monthlyIncome,
        string $branchOpening,
        string $institutionName,
        string $sid,
        string $employerName,
        string $employerAddDet,
        string $employerAddCity,
        string $jobDesc,
        string $ownedBankAccNo,
        string $idIssuingDate
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_REGISTERINVESTOR . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "uuidFaceRecog" => $uuidFaceRecog,
                "title" => $title,
                "firstName" => $firstName,
                "middleName" => $middleName,
                "lastName" => $lastName,
                "optNPWP" => $optNPWP,
                "NPWPNum" => $NPWPNum,
                "nationality" => $nationality,
                "domicileCountry" => $domicileCountry,
                "religion" => $religion,
                "birthPlace" => $birthPlace,
                "birthDate" => $birthDate,
                "gender" => $gender,
                "isMarried" => $isMarried,
                "motherMaidenName" => $motherMaidenName,
                "jobCode" => $jobCode,
                "education" => $education,
                "idType" => $idType,
                "idNumber" => $idNumber,
                "idIssuingCity" => $idIssuingCity,
                "idExpiryDate" => $idExpiryDate,
                "addressStreet" => $addressStreet,
                "addressRtRwPerum" => $addressRtRwPerum,
                "addressKel" => $addressKel,
                "addressKec" => $addressKec,
                "zipCode" => $zipCode,
                "homePhone1" => $homePhone1,
                "homePhone2" => $homePhone2,
                "officePhone1" => $officePhone1,
                "officePhone2" => $officePhone2,
                "mobilePhone1" => $mobilePhone1,
                "mobilePhone2" => $mobilePhone2,
                "faxNum1" => $faxNum1,
                "faxNum2" => $faxNum2,
                "email" => $email,
                "monthlyIncome" => $monthlyIncome,
                "branchOpening" => $branchOpening,
                "institutionName" => $institutionName,
                "sid" => $sid,
                "employerName" => $employerName,
                "employerAddDet" => $employerAddDet,
                "employerAddCity" => $employerAddCity,
                "jobDesc" => $jobDesc,
                "ownedBankAccNo" => $ownedBankAccNo,
                "idIssuingDate" => $idIssuingDate
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function faceRecognition(
        string $companyId,
        string $parentCompanyId,
        string $firstName,
        string $middleName,
        string $lastName,
        string $idNumber,
        string $birthDate,
        string $birthPlace,
        string $gender,
        string $cityAddress,
        string $stateProvAddress,
        string $addressCountry,
        string $streetAddress1,
        string $streetAddress2,
        string $postCodeAddress,
        string $country,
        string $selfiePhoto,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_FACERECOGNITION . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "firstName" => $firstName,
                "middleName" => $middleName,
                "lastName" => $lastName,
                "idNumber" => $idNumber,
                "birthDate" => $birthDate,
                "birthPlace" => $birthPlace,
                "gender" => $gender,
                "cityAddress" => $cityAddress,
                "stateProvAddress" => $stateProvAddress,
                "addressCountry" => $addressCountry,
                "streetAddress1" => $streetAddress1,
                "streetAddress2" => $streetAddress2,
                "postCodeAddress" => $postCodeAddress,
                "country" => $country,
                "selfiePhoto" => $selfiePhoto,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data);

        return Response::RDF($response);
    }

    public function registerInvestorAccount(
        string $companyId,
        string $parentCompanyId,
        string $cifNumber,
        string $currency,
        string $openAccountReason,
        string $sourceOfFund,
        string $branchId,
        string $bnisId,
        string $sre,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_REGISTERINVESTORACCOUNT . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "cifNumber" => $cifNumber,
                "currency" => $currency,
                "openAccountReason" => $openAccountReason,
                "sourceOfFund" => $sourceOfFund,
                "branchId" => $branchId,
                "bnisId" => $bnisId,
                "sre" => $sre
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function inquiryAccountBalance(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_INQUIRYACCOUNTBALANCE . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function inquiryAccountHistory(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_INQUIRYACCOUNTHISTORY . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function paymentUsingTransfer(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber,
        string $beneficiaryAccountNumber,
        string $currency,
        int $amount,
        string $remark,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_PAYMENTUSINGTRANSFER . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber,
                "beneficiaryAccountNumber" => $beneficiaryAccountNumber,
                "currency" => $currency,
                "amount" => $amount,
                "remark" => $remark,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function paymentUsingClearing(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber,
        string $beneficiaryAccountNumber,
        string $beneficiaryAddress1,
        string $beneficiaryAddress2,
        string $beneficiaryBankCode,
        string $beneficiaryName,
        string $currency,
        int $amount,
        string $remark,
        string $chargingType
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_PAYMENTUSINGCLEARING . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber,
                "beneficiaryAccountNumber" => $beneficiaryAccountNumber,
                "beneficiaryAddress1" => $beneficiaryAddress1,
                "beneficiaryAddress2" => $beneficiaryAddress2,
                "beneficiaryBankCode" => $beneficiaryBankCode,
                "beneficiaryName" => $beneficiaryName,
                "currency" => $currency,
                "amount" => $amount,
                "remark" => $remark,
                "chargingType" => $chargingType,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        return Response::RDF($response);
    }

    public function inquiryAccountInfo(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_INQUIRYACCOUNTINFO . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function paymentUsingRTGS(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber,
        string $beneficiaryAccountNumber,
        string $beneficiaryAddress1,
        string $beneficiaryAddress2,
        string $beneficiaryBankCode,
        string $beneficiaryName,
        string $currency,
        int $amount,
        string $remark,
        string $chargingType
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_PAYMENTUSINGRTGS . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber,
                "beneficiaryAccountNumber" => $beneficiaryAccountNumber,
                "beneficiaryAddress1" => $beneficiaryAddress1,
                "beneficiaryAddress2" => $beneficiaryAddress2,
                "beneficiaryBankCode" => $beneficiaryBankCode,
                "beneficiaryName" => $beneficiaryName,
                "currency" => $currency,
                "amount" => $amount,
                "remark" => $remark,
                "chargingType" => $chargingType,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        return Response::RDF($response);
    }

    public function inquiryInterbankAccount(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber,
        string $beneficiaryBankCode,
        string $beneficiaryAccountNumber,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_INQUIRYINTERBANKACCOUNT . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber,
                "beneficiaryBankCode" => $beneficiaryBankCode,
                "beneficiaryAccountNumber" => $beneficiaryAccountNumber,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function inquiryPaymentStatus(
        string $companyId,
        string $parentCompanyId,
        string $requestedUuid
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_INQUIRYPAYMENTSTATUS . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "requestedUuid" => $requestedUuid
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }

    public function paymentUsingInterbank(
        string $companyId,
        string $parentCompanyId,
        string $accountNumber,
        string $beneficiaryAccountNumber,
        string $beneficiaryAccountName,
        string $beneficiaryBankCode,
        string $beneficiaryBankName,
        int $amount,
    ) {
        $url = $this->bni->getBaseUrl() . Constant::URL_RDF_PAYMENTUSINGINTERBANK . '?access_token=' . $this->bni->getToken();
        $data = [
            "request" => [
                "header" => [
                    "companyId" => $companyId,
                    "parentCompanyId" => $parentCompanyId,
                    "requestUuid" => $this->utils->generateUUID(),
                ],
                "accountNumber" => $accountNumber,
                "beneficiaryAccountNumber" => $beneficiaryAccountNumber,
                "beneficiaryAccountName" => $beneficiaryAccountName,
                "beneficiaryBankCode" => $beneficiaryBankCode,
                "beneficiaryBankName" => $beneficiaryBankName,
                "amount" => $amount,
            ]
        ];

        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestRDF($url, $dataJson, $data );
        
        return Response::RDF($response);
    }
}
