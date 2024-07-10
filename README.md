# BNI API SDK - PHP

This is the Official PHP client / library for BNI API.
Please visit [Digital Services](https://digitalservices.bni.co.id/en/) for more information about our product and visit our documentation page at [API Documentation](https://digitalservices.bni.co.id/documentation/public/en) for more technical details.

## 1. Installation

### 1.1 Using Composer

[download](https://getcomposer.org/download/) Composer and run command line

```
composer require bni-api/bni-php-client
```

### 1.2 Manual Installation

If you are not using Composer, you can clone or [download](https://github.com/bni-api/bni-php/archive/refs/heads/main.zip) this repository.

## 2. Usage

### 2.1 Choose an API Product

We have 5 API products you can use:

- [One Gate Payment](https://digitalservices.bni.co.id/api-products-detail/one-gate-payment) - A solution for a company to integrate its application / system with banking transaction services. [documentation](https://digitalservices.bni.co.id/documentation/)
- [Snap BI](https://apidevportal.bi.go.id/snap/info) - Integrate with SNAP BI [documentation](https://apidevportal.bi.go.id/snap/api-services)
- [RDN](https://digitalservices.bni.co.id/api-products-detail/rdn-service) - is BNI's innovation in providing solutions for securities companies in opening digital accounts for investors and can facilitate book-entry transactions by integrating them with API. [documentation](https://digitalservices.bni.co.id/documentation/)
- [RDL](https://digitalservices.bni.co.id/api-products-detail/p2p-lending) - is the provision of financial services to bring together lenders and loan recipients in order to enter into lending and borrowing agreements in rupiah currency directly through an electronic system using the internet network. [documentation](https://digitalservices.bni.co.id/documentation/)
- [RDF](https://digitalservices.bni.co.id/api-products-detail/fintech-account-service) - is a solution for fintech companies registered with OJK in opening digital accounts to facilitate fund transfer transactions by utilizing API technology. [documentation](https://digitalservices.bni.co.id/documentation/)
- [BNI Move](https://digitalservices.bni.co.id/api-products) check out our API here. [documentation](https://digitalservices.bni.co.id/documentation)

### 2.2 Client Initialization and Configuration

Get your client key and server key from [Menu - Applications](https://digitalservices.bni.co.id/en/profile-menu/apps)
Create API client object

```php
use BniApi\BniPhp\Bni;

$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
```

### 2.2.A One Gate Payment

Create `One Gate Payment` class object

```php

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\OneGatePayment;


$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
$ogp = new OneGatePayment($bni);
```

Available methods for `One Gate Payment` class

#### Get Balance

```php
$getbalance = $ogp->getBalance(
  $accountNo = '115471119'
);
```

#### Get In House Inquiry

```php
$getInHouseInquiry = $ogp->getInHouseInquiry(
  $accountNo = '115471119'
);
```

#### Do Payment

```php
$doPayment = $ogp->doPayment(
  $customerReferenceNumber = '20170227000000000020', // max 20 char client defined reference number
  $paymentMethod = '0', // 0: In-house (intra BNI), 1: RTGS transfer, 2: Kliring transfer
  $debitAccountNo = '113183203',
  $creditAccountNo = '115471119',
  $valueDate = '20170227000000000',
  $valueCurrency = 'IDR',
  $valueAmount = '100500',
  $remark = '', // optional
  $beneficiaryEmailAddress = 'mail@example.com', // optional
  $beneficiaryName = 'Mr.X', // optional max 50 char (mandatory if paymentMethod 1 / 2)
  $beneficiaryAddress1 = 'Jakarta', // optional max 50 char (mandatory if paymentMethod 1 / 2)
  $beneficiaryAddress2 = '', // optional max 50 char
  $destinationBankCode = '', // optional (mandatory if paymentMethod 1 / 2)
  $chargingModelId = 'OUR' // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
);
```

#### Get Payment Status

```php
$getPaymentStatus $ogp->getPaymentStatus(
  $customerReferenceNumber = '20170227000000000020' // max 20 char client defined reference number
);
```

#### Get Inter Bank Inquiry

```php
$getInterBankInquiry = $ogp->getInterBankInquiry(
  $customerReferenceNumber = '20170227000000000021', // max 20 char client defined reference number
  $accountNum = '113183203',
  $destinationBankCode = '014',
  $destinationAccountNum = '3333333333'
);
```

#### Get Inter Bank Payment

```php
$getInterBankPayment = $ogp->getInterBankPayment(
  $customerReferenceNumber = '20170227000000000021', // max 20 char client defined reference number
  $amount = '100500',
  $destinationAccountNum = '3333333333',
  $destinationAccountName = 'BENEFICIARY NAME 1 UNTIL HERE1BENEFICIARY NAME 2(OPT) UNTIL HERE2',
  $destinationBankCode = '014',
  $destinationBankName = 'BCA',
  $accountNum = '115471119',
  $retrievalReffNum = '100000000024' // refference number for Interbank Transaction
);
```

### 2.2.B Snap BI

Create `Snap BI` class object

```php

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\SnapBI;


$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
$snap = new SnapBI(
  $bni = '{instance-of-bni-class}',
  $privateKeyPath = '{your-path-private-key}',
  $channelId = '{your-channel}'
);
```

Available methods for `Snap BI` class

#### Balance Inquiry

```php
$balanceInquiry = $snap->balanceInquiry(
  $partnerReferenceNo = '202010290000000000002', // optional
  $accountNo = '0115476117'
);
```

#### Internal Account Inquiry

```php
$internalAccountInquiry = $snap->internalAccountInquiry(
    $partnerReferenceNo = '2023062601000000000509',
    $beneficiaryAccountNo = '317125693'
);
```

#### Transaction Status Inquiry

```php
$transactionStatusInquiry = $snap->transactionStatusInquiry(
  $originalPartnerReferenceNo = '2022051314142684054947620220513141426840549476', // optional
  $originalReferenceNo = '', // transaction reference number
  $originalExternalId = '', // optional
  $serviceCode = '22', // SNAP BI service code
  $transactionDate = '',
  $amountValue = '100000001.00',
  $amountCurrency = 'IDR',
  $addtionalInfoDeviceId = '09864ADCASA', // optinal
  $additionalInfoChannel = 'API', // optinal
);
```

#### Transfer Intra Bank

```php
$transferIntraBank = $snap->transferIntraBank(
  $partnerReferenceNo = '20220426170737356898', // transaction reference number
  $amountValue = '55000.00',
  $amountCurrency = 'IDR',
  $beneficiaryAccountNo = '0115476151',
  $beneficiaryEmail = '', // optional
  $currency = 'IDR', // optional
  $customerReference = '20220426170737356898', // optional
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $remark = '20220426170737356898', // optional
  $sourceAccountNo = '0115476117',
  $transactionDate = '2022-04-26T17:07:36+07:00',
  $additionalInfoDeviceId = '',
  $additionalInfoChannel = ''
);
```

#### Transfer RTGS

```php
$transferRTGS = $snap->transferRTGS(
  $partnerReferenceNo = '20220513095840015788857', // transaction reference number
  $amountValue = '100000001.00',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'PTXYZIndonesia',
  $beneficiaryAccountNo = '3333333333',
  $beneficiaryAccountAddress = 'JlGatotSubrotoNoKav18RW1KuninganBarKecMampangPrptKotaJakartaSelatanDaerahKhususIbukotaJakarta12710'
  $beneficiaryBankCode = 'CENAIDJA',
  $beneficiaryBankName = 'PTBANKCENTRALASIATbk', // optional
  $beneficiaryCustomerResidence = '1',
  $beneficiaryCustomerType = '2',
  $beneficiaryEmail = '-', // optional
  $currency = 'IDR'
  $customerReference = '20220513095840015788857',
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $kodepos = '-', // optional
  $recieverPhone = '-', // optional
  $remark = 'DANA20220513095840015788857PTZomatoMediaIndonesia', // optional
  $senderCustomerResidence = '-', // optional
  $senderCustomerType = '-', // optional
  $senderPhone = '-', // optional
  $sourceAccountNo = '0115476151',
  $transactionDate = '2020-06-17T01:03:04+07:00',
  $additionalInfoDeviceId = '', // optional
  $additionalInfoChannel = '' // optional
);
```

#### Transfer SKNBI

```php
$transferSKNBI = $snap->transferSKNBI(
  $partnerReferenceNo = '2022101829912160579817066466', // transaction reference number
  $amountValue = '120000000.00',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'Trinawati Eka Putri',
  $beneficiaryAccountNo = '0115476117',
  $beneficiaryAccountAddress = 'Palembang', // optional
  $beneficiaryBankCode = 'CENAIDJAXXX',
  $beneficiaryBankName = 'PT. BANK CENTRAL ASIA Tbk.', // optional
  $beneficiaryCustomerResidence = '1',
  $beneficiaryCustomerType = '1',
  $beneficiaryEmail = 'xyz@xyz.co.id' // optional
  $currency = 'IDR', // optional
  $customerReference = '56756567567',
  $feeType = 'BEN', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $kodepos = '-', // optional
  $recieverPhone = '-', // optional
  $remark = 'remark test', // optional
  $senderCustomerResidence = '', // optional
  $senderCustomerType = '', // optional
  $senderPhone = '', // optional
  $sourceAccountNo = '0115476151',
  $transactionDate = '2022-10-18T09:44:44+07:00',
  $additionalInfoDeviceId = 'Biaya Hidup Pihak Asing', // optional
  $additionalInfoChannel = '01' // optional
);
```

#### External Account Inquiry

```php
$externalAccountInquiry = $snap->externalAccountInquiry(
  $beneficiaryAccountNo = '123456789',
  $partnerReferenceNo = '20240226163135663', // optional
  $beneficiaryBankCode = 'CENAIDJAXXX',
  $additionalInfoDeviceId = '09864ADCASA', // optional
  $additionalInfoChannel = 'API' // optional
);
```

#### Transfer Inter Bank

```php
$transferInterBank = $snap->transferInterBank(
  $partnerReferenceNo = '20240226163731861', // transaction reference number
  $amountValue = '20000',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'SRI ANGGRAINI',
  $beneficiaryAccountNo = '0000000986',
  $beneficiaryAccountAddress = 'Palembang', // optional
  $beneficiaryBankCode = '014',
  $beneficiaryBankName = 'Bank BCA', // optional
  $beneficiaryEmail = 'customertes@outlook.com', // optional
  $currency = 'IDR', // optional
  $customerReference = '20231219085', // optional
  $sourceAccountNo = '1000161562',
  $transactionDate = '2024-01-04T08:37:08+07:00',
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $additionalInfoDeviceId = '09864ADCASA', // optional
  $additionalInfoChannel = 'API' // optional
);
```

### 2.2.C Autopay SNAP

Create `Autopay` class object
```php

use BniApi\BniPhp\api\Autopay;

$autopay = new Autopay(
  $merchantID,
  $clientID,
  $clientSecret,
  $privateKey,
  'alpha'
);
```

Available methods for `Autopay` class
#### Account Binding
```php
$response = $autopay->accountBinding(
  $partnerReferenceNo = '123456789009876544002',
  $bankAccountNo = '92345678902787',
  $bankCardNo = '92345678902788',
  $limit = 250000.00,
  $email = 'burhanaji2@gmail.com',
  $custIdMerchant = '92345678902788'
);
```

#### Account Unbinding
```php
$response = $autopay->accountUnbinding(
  $partnerReferenceNo = '12345678900987654484',
  $bankCardToken =
      'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
      'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ',
  $chargeToken = 'Xob2d8BlMxVyQRloodpujCIvuFortJ',
  $otp = '',
  $custIdMerchant = '12313213131'
);
```

#### Balance Inquiry
```php
$response = $autopay->balanceInquiry(
  $partnerReferenceNo = '2023102899999999999902',
  $accountNo = '9234567846',
  $amount = 1000.00,
  $bankCardToken =
      'q3jcQJJTrBvYzUt2VyzY68Klw8mG400K5NWaAL5JdTbjAqjXBG9LZr' .
      '0F4khuVdrezjXFLEJRzvmF5xLZhT2fJj73FbQlf9FeqGCNW8HKSEOpzz83HYkUaQWBX2TPkaJM'
);
```

#### Debit / Payment
```php
$response = $autopay->debit(
  $partnerReferenceNo = '123456789009876477',
  $bankCardToken      =
      'YKYpg4xqTK1IuhlGQnrpiXHnxTcFx8ntjVfggWddVtTqsD8aUvi74oSijcVF0eV9' .
      '1zVbCganXNROsFUURUzPLWbSZp5yHKmMnijS4D2yrMeJ7yJHHTYtRHpCP2GcoXJ3',
  $chargeToken = 'ZDkLEQDZspP9FbahGkJoo3NmiSC6p0',
  $otp         = '',
  $amount      = [
      'value'    => '1000.00',
      'currency' => 'IDR'
  ],
  $remark      = 'remark'
);
```

#### Debit Refund
```php
$response = $autopay->debitRefund(
  $originalPartnerReferenceNo = '123456789009876408',
  $partnerRefundNo            = '223456789009876487',
  $refundAmount               = [
      'value'    => 1000.00,
      'currency' => 'IDR'
  ],
  $reason     = 'Complaint from customer',
  $refundType = 'full'
);
```

#### Debit Status
```php
$response = $autopay->debitStatus(
  $originalPartnerReferenceNo = '123456789009876408',
  $transactionDate            = '20220419',
  $serviceCode                = '54',
  $amount                     = [
      'value'    => 1000.00,
      'currency' => 'IDR'
  ]
);
```

#### Limit Inquiry
```php
$response = $autopay->limitInquiry(
  $partnerReferenceNo = '2020102900000000000001',
  $bankCardToken      = '6d7963617264746f6b656e',
  $accountNo          = '7382382957893840',
  $amount             = 200000.00
);
```

#### OTP
```php
$response = $autopay->otp(
  $partnerReferenceNo = '12345678900987654484',
  $journeyID          = '12345678900987654484',
  $bankCardToken      = 
      'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
      'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ',
  $otpReasonCode  = '54',
  $additionalInfo = [
      'expiredOtp' => "2023-07-26T18:56:11+07:00",
  ],
  $externalStoreId = '134928924949479'
);
```

#### Verify OTP
```php
$response = $autopay->verifyOtp(
  $originalPartnerReferenceNo = '123456789009876533',
  $originalReferenceNo        = '7979309099377000825262452054700150269920536175232508970766089901',
  $chargeToken                = 'dI7aK7aEbdgeMDnG2ygcEHQpyJQINm',
  $otp                        = '359677'
);
```

#### Set Limit
```php
$response = $autopay->setLimit(
  $partnerReferenceNo = '12345678900987654484',
  $bankCardToken      = 
      'vvSWxFEu5p6ONXT3qEoZ2L5o7YJ4UjH7Mee3SDuxigMixnfVuOnQpbJxuboXijOAlna' .
      'ow6XVqP7VCyQqSSzdv24OQjGl7IRuUAVcAgzKzJQoybSLPk0kKKCdqJqwrOXZ',
  $limit              = 250000.00,
  $chargeToken        = '931C5fuQgmB3FICZOag30G9p0X4Gtb',
  $otp                = '898201'
);
```

### 2.2.D Ecollection

Create `Ecollection` class object
```php

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\SnapBI;


$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}', // clientId consists prefix and client id separated with dash (-) character. Example: 8-000. 8 as prefix, 000 as client id
  $clientSecret = '{your-client-secret}', // client secret key
  $apiKey = '{your-api-key}', // can be emptied
  $apiSecret = '{your-api-secret}', // can be emptied
  $appName = '{your-app-name}' // can be emptied
);

$ecoll = new Ecollection($bni);
```
Available methods for `Ecollection` class
#### Create Billing
```php
$createBilling = $ecoll->createBilling(
    $trxId = "trx-id899", // mandatory
    $trxAmount = "100000", // mandatory except billing type is "o" (open payment)
    $billingType = "c", // mandatory. Credit: o,c,i,m,n,x. Debit: p,j,d,z
    $customerName = "test name", // mandatory
    $customerEmail = "mail@example.com", // optional
    $customerPhone = "08123123", // optional
    $virtualAccount = "", // optional, if empty then autogenerated
    $datetimeExpired = "2023-09-31T17:00:00+07:00", // optional
    $description = "test description update", // optional
);
```
#### Update Billing
```php
$updateBilling = $ecoll->updateBilling(
    $trxId = "trx-id6", // mandatory
    $trxAmount = "100000", // mandatory except billing type is "o" (open payment)
    $customerName = "test name updated", // mandatory
    $customerEmail = "", // optional
    $customerPhone = "", // optional
    $virtualAccount = "8325201106194912", // optional
    $datetimeExpired = "2023-09-31T17:00:00+07:00", // optional
    $description = "test description update", // optional
);
```
#### Inquiry Billing
```php
$inquiryBilling = $ecoll->inquiryBilling(
    $trxId = "trx-id6",
);
```
#### Inactive Billing
```php
$inactiveBilling = $ecoll->inactiveBilling(
    $trxId = "trx-id6", // mandatory
    $virtualAccount = "8325201106194911" // mandatory
);

### 2.2.C Fintech Account Service (RDF)

Create `RDF` Class Object

```php
use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\RDF;

$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
$rdf = new RDF(
  $bni = '{instance-of-bni-class}',
  $privateKeyPath = '{your-path-private-key}',
  $channelId = '{your-channel}'
);
```

#### Face Recognition

```php
$faceRecognition = $rdf->faceRecognition(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $firstName = 'MOHAMMAD',
  $middleName = 'BAQER',
  $lastName = 'ZALQAD',
  $idNumber = '0141111121260118', // Identity Number (KTP only)
  $birthDate = '29-09-2021', // format : DD-MM-YYYY
  $birthPlace = 'BANDUNG',
  $gender = 'M', // “M” or “F”
  $cityAddress = 'Bandung',
  $stateProvAddress = 'Jawa Barat',
  $addressCountry = 'ID', // e.g.: “ID”
  $streetAddress1 = 'bandung',
  $streetAddress2 = 'bandung',
  $postCodeAddress = '40914',
  $country = 'ID', // e.g.: “ID”
  $selfiePhoto = '29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuP', // Base64 encoded selfie photo
);
```

#### Register Investor

```php
$registerInvestor = $rdf->registerInvestor(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $uuidFaceRecog = '492F33851D634CFB', // RequestUuid successed value from Face Recognition API (KYC valid)
  $title = '01',
  $firstName = 'Agus',
  $middleName = '',
  $lastName = 'Saputra',
  $optNPWP = '1', // “1” or “0” (Default “1”)
  $NPWPNum = '001058893408123',
  $nationality = 'ID', // e.g.: “ID”
  $domicileCountry = 'ID', // e.g.: “ID”
  $religion = '2',
  $birthPlace = 'Semarang',
  $birthDate = '14081982', // DDMMYYYY
  $gender = 'M', // “M” or “F”
  $isMarried = 'S',
  $motherMaidenName = 'Dina Maryati',
  $jobCode = '01',
  $education = '07',
  $idType = '01',
  $idNumber = '4147016201959998', // Identity Number (KTP only)
  $idIssuingCity = 'Jakarta Barat',
  $idExpiryDate = '26102099', // ddMMyyyy
  $addressStreet = 'Jalan Mawar Melati',
  $addressRtRwPerum = '003009Sentosa',
  $addressKel = 'Cengkareng Barat',
  $addressKec = 'Cengkareng/Jakarta Barat',
  $zipCode = '11730',
  $homePhone1 = '0214', // Area code, e.g. 021 (3 - 4 digit) If not exist, fill with “9999”
  $homePhone2 = '7459', // Number after area code (min 4  digit) If not exist, fill with “99999999”
  $officePhone1 = '', // Area code, e.g. 021
  $officePhone2 = '', // Number after area code
  $mobilePhone1 = '0812', // Operator code, e.g. 0812 (4 digit) If not exist, fill with “0899”
  $mobilePhone2 = '12348331', // Number after operator code (min 6  digit) If not exist, fill with “999999”
  $faxNum1 = '', // Area code, e.g. 021
  $faxNum2 = '', // Number after area code
  $email = 'agus.saputra@gmail.com',
  $monthlyIncome = '8000000',
  $branchOpening = '0259',
  $institutionName = 'PT. BNI SECURITIES',
  $sid = 'IDD280436215354',
  $employerName = 'Salman', // Employer Name / Company Name
  $employerAddDet = 'St Baker', // Employer street address / home street address
  $employerAddCity = 'Arrandelle', // Employer city address / home city address
  $jobDesc = 'Pedagang' // Current investor job,
  $ownedBankAccNo = '0337109074', // Investor’s owned bank account
  $idIssuingDate = '10122008' // Issue date, e.g.: “10122016”
);
```

#### Register Investor's Account

```php
$registerInvestorAccount = $rdf->registerInvestorAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $cifNumber = '9100749959',
  $currency = 'IDR',
  $openAccountReason = '2',
  $sourceOfFund = '1',
  $branchId = '0259',
  $bnisId = '19050813401',
  $sre = 'NI001CX5U00109',
)
```

#### Inquiry Account Info

```php
$inquiryAccountInfo = $rdf->inquiryAccountInfo(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account Balance

```php
$inquiryAccountBalance = $rdf->inquiryAccountBalance(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account History

```php
$inquiryAccountHistory = $rdf->inquiryAccountHistory(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Payment Using Transfer

```php
$paymentUsingTransfer = $rdf->paymentUsingTransfer(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '0115471119',
  $currency = 'IDR', // e.g., “IDR”
  $amount = '11500',
  $remark = 'Test RDN' // Recommended for the reconciliation purpose
)
```

#### Inquiry Payment Status

```php
$inquiryPaymentStatus = $rdf->inquiryPaymentStatus(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $requestedUuid = 'E8C6E0027F6E429F' // UUID that has been processed before

)
```

#### Payment Using Clearing

```php
$paymentUsingClearing = $rdf->paymentUsingClearing(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = '140397',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 15000,
  $remark = 'Test kliring', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Payment Using RTGS

```php
$paymentUsingRTGS = $rdf->paymentUsingRTGS(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = 'CENAIDJA',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 120000000,
  $remark = 'Test rtgs', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Inquiry Interbank Account

```php
$inquiryInterbankAccount = $rdf->inquiryInterbankAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryBankCode = '013',
  $beneficiaryAccountNumber = '01300000',
)
```

#### Payment Using Interbank

```php
$paymentUsingInterbank = $rdf->paymentUsingInterbank(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAccountName = 'KEN AROK', // Get from Inquiry Interbank Account
  $beneficiaryBankCode = '014',
  $beneficiaryBankName = 'BANK BCA', // Get from Inquiry Interbank Account
  $amount = 15000,
)
```

### 2.2.D RDN Service

Create `RDN` Class Object

```php
use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\RDN;

$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
$rdn = new RDN(
  $bni = '{instance-of-bni-class}',
  $privateKeyPath = '{your-path-private-key}',
  $channelId = '{your-channel}'
);
```

#### Face Recognition

```php
$faceRecognition = $rdn->faceRecognition(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $firstName = 'MOHAMMAD',
  $middleName = 'BAQER',
  $lastName = 'ZALQAD',
  $idNumber = '0141111121260118', // Identity Number (KTP only)
  $birthDate = '29-09-2021', // format : DD-MM-YYYY
  $birthPlace = 'BANDUNG',
  $gender = 'M', // “M” or “F”
  $cityAddress = 'Bandung',
  $stateProvAddress = 'Jawa Barat',
  $addressCountry = 'ID', // e.g.: “ID”
  $streetAddress1 = 'bandung',
  $streetAddress2 = 'bandung',
  $postCodeAddress = '40914',
  $country = 'ID', // e.g.: “ID”
  $selfiePhoto = '29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuP', // Base64 encoded selfie photo
);
```

#### Check SID

```php
$checkSID = $rdn->checkSID(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'KSEI',
  $requestUuid = '52D3E26AA18D4FCA',
  $participantId = 'NI001',
  $sidNumber = 'IDD1206M9527805',
  $accountNumberOnKsei = 'NI001CRKG00146',
  $branchCode = '0259',
  $ack = 'N'
);
```

#### Register Investor

```php
$registerInvestor = $rdn->registerInvestor(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $uuidFaceRecog = '492F33851D634CFB', // RequestUuid successed value from Face Recognition API (KYC valid)
  $title = '01',
  $firstName = 'Agus',
  $middleName = '',
  $lastName = 'Saputra',
  $optNPWP = '1', // “1” or “0” (Default “1”)
  $NPWPNum = '001058893408123',
  $nationality = 'ID', // e.g.: “ID”
  $domicileCountry = 'ID', // e.g.: “ID”
  $religion = '2',
  $birthPlace = 'Semarang',
  $birthDate = '14081982', // DDMMYYYY
  $gender = 'M', // “M” or “F”
  $isMarried = 'S',
  $motherMaidenName = 'Dina Maryati',
  $jobCode = '01',
  $education = '07',
  $idType = '01',
  $idNumber = '4147016201959998', // Identity Number (KTP only)
  $idIssuingCity = 'Jakarta Barat',
  $idExpiryDate = '26102099', // ddMMyyyy
  $addressStreet = 'Jalan Mawar Melati',
  $addressRtRwPerum = '003009Sentosa',
  $addressKel = 'Cengkareng Barat',
  $addressKec = 'Cengkareng/Jakarta Barat',
  $zipCode = '11730',
  $homePhone1 = '0214', // Area code, e.g. 021 (3 - 4 digit) If not exist, fill with “9999”
  $homePhone2 = '7459', // Number after area code (min 4  digit) If not exist, fill with “99999999”
  $officePhone1 = '', // Area code, e.g. 021
  $officePhone2 = '', // Number after area code
  $mobilePhone1 = '0812', // Operator code, e.g. 0812 (4 digit) If not exist, fill with “0899”
  $mobilePhone2 = '12348331', // Number after operator code (min 6  digit) If not exist, fill with “999999”
  $faxNum1 = '', // Area code, e.g. 021
  $faxNum2 = '', // Number after area code
  $email = 'agus.saputra@gmail.com',
  $monthlyIncome = '8000000',
  $branchOpening = '0259',
  $institutionName = 'PT. BNI SECURITIES',
  $sid = 'IDD280436215354',
  $employerName = 'Salman', // Employer Name / Company Name
  $employerAddDet = 'St Baker', // Employer street address / home street address
  $employerAddCity = 'Arrandelle', // Employer city address / home city address
  $jobDesc = 'Pedagang' // Current investor job,
  $ownedBankAccNo = '0337109074', // Investor’s owned bank account
  $idIssuingDate = '10122008' // Issue date, e.g.: “10122016”
);
```

#### Register Investor's Account

```php
$registerInvestorAccount = $rdn->registerInvestorAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $cifNumber = '9100749959',
  $currency = 'IDR',
  $openAccountReason = '2',
  $sourceOfFund = '1',
  $branchId = '0259',
  $bnisId = '19050813401',
  $sre = 'NI001CX5U00109',
)
```

#### Send Data Static

```php
$sendDataStatic = $rdn->sendDataStatic(
  $companyId = 'SPS App',
  $parentCompanyId = 'KSEI',
  $participantCode = 'NI001', // Institution code, e.g: “NI001”
  $participantName = 'PT. BNI SECURITIES', // Institution name, e.g.: “PT. BNI SECURITIES”
  $investorName = 'SUMARNO',
  $investorCode = 'IDD250436742277', // Investor code, e.g.: “IDD250436742277”
  $investorAccountNumber = 'NI001042300155', //  e.g.: “NI001042300155”
  $bankAccountNumber = '242345393', // e.g.: “242345393”
  $activityDate = '20180511', // yyyyMMdd, e.g: “20180511”
  $activity = 'O' // (O)pening / (C)lose / (B)lock Account / (U)nblock Account
)
```

#### Inquiry Account Info

```php
$inquiryAccountInfo = $rdn->inquiryAccountInfo(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account Balance

```php
$inquiryAccountBalance = $rdn->inquiryAccountBalance(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account History

```php
$inquiryAccountHistory = $rdn->inquiryAccountHistory(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Payment Using Transfer

```php
$paymentUsingTransfer = $rdn->paymentUsingTransfer(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '0115471119',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 11500,
  $remark = 'Test RDN' // Recommended for the reconciliation purpose
)
```

#### Inquiry Payment Status

```php
$inquiryPaymentStatus = $rdn->inquiryPaymentStatus(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $requestedUuid = 'E8C6E0027F6E429F' // UUID that has been processed before

)
```

#### Payment Using Clearing

```php
$paymentUsingClearing = $rdn->paymentUsingClearing(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = '140397',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 15000,
  $remark = 'Test kliring', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Payment Using RTGS

```php
$paymentUsingRTGS = $rdn->paymentUsingRTGS(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = 'CENAIDJA',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 120000000,
  $remark = 'Test rtgs', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Inquiry Interbank Account

```php
$inquiryInterbankAccount = $rdn->inquiryInterbankAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryBankCode = '013',
  $beneficiaryAccountNumber = '01300000',
)
```

#### Payment Using Interbank

```php
$paymentUsingInterbank = $rdn->paymentUsingInterbank(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAccountName = 'KEN AROK', // Get from Inquiry Interbank Account
  $beneficiaryBankCode = '014',
  $beneficiaryBankName = 'BANK BCA', // Get from Inquiry Interbank Account
  $amount = 15000,
)
```

### 2.2.E P2P Lending Service (RDL)

Create `RDL` Class Object

```php
use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\RDL;

$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
$rdl = new RDL(
  $bni = '{instance-of-bni-class}',
  $privateKeyPath = '{your-path-private-key}',
  $channelId = '{your-channel}'
);
```

#### Face Recognition

```php
$faceRecognition = $rdl->faceRecognition(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $firstName = 'MOHAMMAD',
  $middleName = 'BAQER',
  $lastName = 'ZALQAD',
  $idNumber = '0141111121260118', // Identity Number (KTP only)
  $birthDate = '29-09-2021', // format : DD-MM-YYYY
  $birthPlace = 'BANDUNG',
  $gender = 'M', // “M” or “F”
  $cityAddress = 'Bandung',
  $stateProvAddress = 'Jawa Barat',
  $addressCountry = 'ID', // e.g.: “ID”
  $streetAddress1 = 'bandung',
  $streetAddress2 = 'bandung',
  $postCodeAddress = '40914',
  $country = 'ID', // e.g.: “ID”
  $selfiePhoto = '29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuP', // Base64 encoded selfie photo
);
```

#### Register Investor

```php
$registerInvestor = $rdl->registerInvestor(
  $companyId = 'SANDBOX',
  $parentCompanyId = 'STI_CHS',
  $uuidFaceRecog = '492F33851D634CFB', // RequestUuid successed value from Face Recognition API (KYC valid)
  $title = '01',
  $firstName = 'Agus',
  $middleName = '',
  $lastName = 'Saputra',
  $optNPWP = '1', // “1” or “0” (Default “1”)
  $NPWPNum = '001058893408123',
  $nationality = 'ID', // e.g.: “ID”
  $domicileCountry = 'ID', // e.g.: “ID”
  $religion = '2',
  $birthPlace = 'Semarang',
  $birthDate = '14081982', // DDMMYYYY
  $gender = 'M', // “M” or “F”
  $isMarried = 'S',
  $motherMaidenName = 'Dina Maryati',
  $jobCode = '01',
  $education = '07',
  $idType = '01',
  $idNumber = '4147016201959998', // Identity Number (KTP only)
  $idIssuingCity = 'Jakarta Barat',
  $idExpiryDate = '26102099', // ddMMyyyy
  $addressStreet = 'Jalan Mawar Melati',
  $addressRtRwPerum = '003009Sentosa',
  $addressKel = 'Cengkareng Barat',
  $addressKec = 'Cengkareng/Jakarta Barat',
  $zipCode = '11730',
  $homePhone1 = '0214', // Area code, e.g. 021 (3 - 4 digit) If not exist, fill with “9999”
  $homePhone2 = '7459', // Number after area code (min 4  digit) If not exist, fill with “99999999”
  $officePhone1 = '', // Area code, e.g. 021
  $officePhone2 = '', // Number after area code
  $mobilePhone1 = '0812', // Operator code, e.g. 0812 (4 digit) If not exist, fill with “0899”
  $mobilePhone2 = '12348331', // Number after operator code (min 6  digit) If not exist, fill with “999999”
  $faxNum1 = '', // Area code, e.g. 021
  $faxNum2 = '', // Number after area code
  $email = 'agus.saputra@gmail.com',
  $monthlyIncome = '8000000',
  $branchOpening = '0259',
  $institutionName = 'PT. BNI SECURITIES',
  $sid = 'IDD280436215354',
  $employerName = 'Salman', // Employer Name / Company Name
  $employerAddDet = 'St Baker', // Employer street address / home street address
  $employerAddCity = 'Arrandelle', // Employer city address / home city address
  $jobDesc = 'Pedagang' // Current investor job,
  $ownedBankAccNo = '0337109074', // Investor’s owned bank account
  $idIssuingDate = '10122008' // Issue date, e.g.: “10122016”
);
```

#### Register Investor's Account

```php
$registerInvestorAccount = $rdl->registerInvestorAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $cifNumber = '9100749959',
  $currency = 'IDR',
  $openAccountReason = '2',
  $sourceOfFund = '1',
  $branchId = '0259',
  $bnisId = '19050813401',
  $sre = 'NI001CX5U00109',
)
```

#### Inquiry Account Info

```php
$inquiryAccountInfo = $rdl->inquiryAccountInfo(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account Balance

```php
$inquiryAccountBalance = $rdl->inquiryAccountBalance(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Inquiry Account History

```php
$inquiryAccountHistory = $rdl->inquiryAccountHistory(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117'
)
```

#### Payment Using Transfer

```php
$paymentUsingTransfer = $rdl->paymentUsingTransfer(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '0115471119',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 11500,
  $remark = 'Test RDN' // Recommended for the reconciliation purpose
)
```

#### Inquiry Payment Status

```php
$inquiryPaymentStatus = $rdl->inquiryPaymentStatus(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $requestedUuid = 'E8C6E0027F6E429F' // UUID that has been processed before

)
```

#### Payment Using Clearing

```php
$paymentUsingClearing = $rdl->paymentUsingClearing(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = '140397',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 15000,
  $remark = 'Test kliring', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Payment Using RTGS

```php
$paymentUsingRTGS = $rdl->paymentUsingRTGS(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAddress1 = 'Jakarta',
  $beneficiaryAddress2 = '',
  $beneficiaryBankCode = 'CENAIDJA',
  $beneficiaryName = 'Panji Samudra',
  $currency = 'IDR', // e.g., “IDR”
  $amount = 120000000,
  $remark = 'Test rtgs', // Recommended for the reconciliation purpose
  $chargingType = 'OUR'
)
```

#### Inquiry Interbank Account

```php
$inquiryInterbankAccount = $rdl->inquiryInterbankAccount(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryBankCode = '013',
  $beneficiaryAccountNumber = '01300000',
)
```

#### Payment Using Interbank

```php
$paymentUsingInterbank = $rdl->paymentUsingInterbank(
  $companyId = 'NI001',
  $parentCompanyId = 'KSEI',
  $accountNumber = '0115476117',
  $beneficiaryAccountNumber = '3333333333',
  $beneficiaryAccountName = 'KEN AROK', // Get from Inquiry Interbank Account
  $beneficiaryBankCode = '014',
  $beneficiaryBankName = 'BANK BCA', // Get from Inquiry Interbank Account
  $amount = 15000,
)
```

### 2.2.F Digiloan BNI Move

Create `Bni Move` Class Object

```php
use BniApi\BniPhp\Bni;
use BniApi\BniPhp\api\RDL;

$bni = new Bni(
  $env = 'sandbox', // dev, sandbox, prod
  $clientId = '{your-client-id}',
  $clientSecret = '{your-client-secret}',
  $apiKey = '{your-api-key}',
  $apiSecret = '{your-api-secret}',
  $appName = '{your-app-name}'
);
```

#### Prescreening

```php
$bniMove = new BniMove($bni)
$prescreening = $bniMove->prescreening(
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
```
#### Save Image

```php
$bniMove = new BniMove($bni)
$prescreening = $bniMove->saveImage(
  $Id = 'MJO2024022000004',
  $deskripsi = 'Foto Identitas KTP',
  $jenisDokumen = 'A03',
  $namaFile = 'Foto KTP',
  $extensionFile = 'png',
  $dataBase64 = '{image}' #convert your image to base64
);
```


## Get help

- [Digital Services](https://digitalservices.bni.co.id/en/)
- [API documentation](https://digitalservices.bni.co.id/documentation/public/en)
- [Stackoverflow](https://stackoverflow.com/users/19817167/bni-api-management)
- Can't find answer you looking for? email to [apisupport@bni.co.id](mailto:apisupport@bni.co.id)
