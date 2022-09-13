BNI API SDK - PHP
===============
This is the Official PHP client / library for BNI API. 
Please visit [Digital Services](https://digitalservices.bni.co.id/en/) for more information about our product and visit our documentation page at [API Documentation](https://digitalservices.bni.co.id/documentation/public/en) for more technical details.

## 1. Installation

### 1.1 Using Composer
[download](https://getcomposer.org/download/)  Composer and run command line

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
$bni = new Bni(
  $prod = false,
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
$bni = new Bni(
  $prod = false,
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
$bni = new Bni(
  $prod = false,
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

## Get help

* [Digital Services](https://digitalservices.bni.co.id/en/)
* [API documentation](https://digitalservices.bni.co.id/documentation/public/en)
* [Stackoverflow](https://stackoverflow.com/users/19817167/bni-api-management)
* Can't find answer you looking for? email to [apisupport@bni.co.id](mailto:apisupport@bni.co.id)
