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

We have 2 API products you can use:

- [One Gate Payment](#22A-snap) - A solution for a company to integrate its application / system with banking transaction services. [documentation](https://digitalservices.bni.co.id/en/api-one-gate-payment)
- [Snap BI](https://apidevportal.bi.go.id/snap/info) - Integrate with SNAP BI [documentation](https://apidevportal.bi.go.id/snap/api-services)

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

#### Hold Amount

```php
$holdAmount = $ogp->holdAmount(
  $customerReferenceNumber = '20170504153218296', // max 20 char client defined reference number
  $amount = '12007',
  $accountNo = '0115476151',
  $detail = '' // optional
);
```

#### Hold Amount Release

```php
$holdAmountRelease =  $ogp->holdAmountRelease(
  $customerReferenceNumber = '20170504153218296', // max 20 char client defined reference number
  $amount = 12007,
  $accountNo = '0115476151',
  $bankReference = '513668', // journal number. you can get this value from hold amount response
  $holdTransactionDate = '31052010' // the date when you do the hold transaction
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

#### Bank Statement

```php
$bankStatement = $snap->bankStatement(
  $partnerReferenceNo = '202010290000000000002', // optional
  $accountNo = '0115476117',
  $fromDateTime = '2010-01-01T12:08:56+07:00', // optional
  $toDateTime = '2011-01-01T12:08:56+07:00' // optional
);
```

#### Internal Account Inquiry

```php
$internalAccountInquiry = $snap->internalAccountInquiry(
  $partnerReferenceNo = '2020102900000000000001', // optional
  $beneficiaryAccountNo = '0115476151'
);
```

#### Transaction Status Inquiry

```php
$transactionStatusInquiry = $snap->transactionStatusInquiry(
  $originalPartnerReferenceNo = '20211213100434', // optional
  $originalReferenceNo = '20211220141520', // transaction reference number
  $originalExternalId = '20211220141520', // optional
  $serviceCode = '36', // SNAP BI service code
  $transactionDate = '2021-12-20',
  $amountValue = '12500.00',
  $amountCurrency = 'IDR',
  $addtionalInfoDeviceId = '123456', // optinal
  $additionalInfoChannel = 'mobilephone', // optinal
);
```

#### Transfer Intra Bank

```php
$transferIntraBank = $snap->transferIntraBank(
  $partnerReferenceNo = '202201911020300006', // transaction reference number
  $amountValue = '12500',
  $amountCurrency = 'IDR',
  $beneficiaryAccountNo = '0115476117',
  $beneficiaryEmail = 'mail@example.com', // optional
  $currency = 'IDR', // optional
  $customerReference = '14045', // optional
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $remark = '', // optional
  $sourceAccountNo = '0115476151',
  $transactionDate = '2021-12-13',
  $additionalInfoDeviceId = '123456',
  $additionalInfoChannel = 'mobilephone'
);
```

#### Transfer RTGS

```php
$transferRTGS = $snap->transferRTGS(
  $partnerReferenceNo = '202201911020300011', // transaction reference number
  $amountValue = '150005001',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'SAN',
  $beneficiaryAccountNo = '3333333333',
  $beneficiaryBankCode = 'CENAIDJA',
  $beneficiaryBankName = 'Jakarta Barat', // optional
  $beneficiaryCustomerResidence = '1',
  $beneficiaryCustomerType = '1',
  $beneficiaryEmail = 'mail@example.com', // optional
  $customerReference = '202201911020300006',
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $kodepos = '12550', // optional
  $recieverPhone = '08123456789', // optional
  $remark = '', // optional
  $senderCustomerResidence = '1', // optional
  $senderCustomerType = '1', // optional
  $senderPhone = '08123456789', // optional
  $sourceAccountNo = '0115476151',
  $transactionDate = '2022-01-25',
  $additionalInfoDeviceId = '123456', // optional
  $additionalInfoChannel = 'mobilephone' // optional
);
```

#### Transfer SKNBI

```php
$transferSKNBI = $snap->transferSKNBI(
  $partnerReferenceNo = '202201911020300012', // transaction reference number
  $amountValue = '150005001',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'SAN',
  $beneficiaryAccountNo = '3333333333',
  $beneficiaryAccountAddress = 'Jakarta Barat', // optional
  $beneficiaryBankCode = '0140397',
  $beneficiaryBankName = 'PT. BANK CENTRAL ASIA Tbk.', // optional
  $beneficiaryCustomerResidence = '1',
  $beneficiaryCustomerType = '1',
  $beneficiaryEmail = 'mail@example.com' // optional
  $currency = 'IDR', // optional
  $customerReference = '202201911020300006',
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $kodepos = '12550', // optional
  $recieverPhone = '08123456789', // optional
  $remark = '', // optional
  $senderCustomerResidence = '1', // optional
  $senderCustomerType = '1', // optional
  $senderPhone = '08123456789', // optional
  $sourceAccountNo = '0115476151',
  $transactionDate = '2022-01-25',
  $additionalInfoDeviceId = '123456', // optional
  $additionalInfoChannel = 'mobilephone' // optional
);
```

#### External Account Inquiry

```php
$externalAccountInquiry = $snap->externalAccountInquiry(
  $beneficiaryBankCode = '002',
  $beneficiaryAccountNo = '888801000157508',
  $partnerReferenceNo = '2020102900000000000001', // optional
  $additionalInfoDeviceId = '123456', // optional
  $additionalInfoChannel = 'mobilephone' // optional
);
```

#### Transfer Inter Bank

```php
$transferInterBank = $snap->transferInterBank(
  $partnerReferenceNo = '2020102900000000000001', // transaction reference number
  $amountValue = '12345678.00',
  $amountCurrency = 'IDR',
  $beneficiaryAccountName = 'Yories Yolanda',
  $beneficiaryAccountNo = '888801000003301',
  $beneficiaryAccountAddress = 'Palembang', // optional
  $beneficiaryBankCode = '002',
  $beneficiaryBankName = 'Bank BRI', // optional
  $beneficiaryEmail = 'mail@example.com', // optional
  $currency = 'IDR', // optional
  $customerReference = '10052019', // optional
  $sourceAccountNo = '888801000157508',
  $transactionDate = '2019-07-03T12:08:56-07:00',
  $feeType = 'OUR', // OUR: fee will be paid by sender (default), BEN: fee will be paid by beneficary, SHA: fee divided
  $additionalInfoDeviceId = '123456', // optional
  $additionalInfoChannel = 'mobilephone' // optional
);
```

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

## Get help

- [Digital Services](https://digitalservices.bni.co.id/en/)
- [API documentation](https://digitalservices.bni.co.id/documentation/public/en)
- [Stackoverflow](https://stackoverflow.com/users/19817167/bni-api-management)
- Can't find answer you looking for? email to [apisupport@bni.co.id](mailto:apisupport@bni.co.id)
