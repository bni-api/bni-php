<?php 

namespace BniApi\BniPhp\test;

use BniApi\BniPhp\api\BNIDirect;
use BniApi\BniPhp\Bni;
use PHPUnit\Framework\TestCase;

class BniDirectTest extends TestCase
{
    private function init()
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new Bni(
            $env = 'sandbox',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName,
        );
    }

    public function BniDirect(Bni $bni)
    {
        $credentials = json_decode(file_get_contents(__DIR__ . '/constant.json'));
        return new BNIDirect(
            $bni,
            $credentials->api_services->bniDirectApiKey
        );
    }

    // public function test_bni_direct_create_mpng2_billing_id()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->createMPNG2Billing([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'npwp' => '312312309013000',
    //         'taxPayerName' => 'NAMA NPWP',
    //         'taxPayerAddress1' => 'ALAMAT 1',
    //         'taxPayerAddress2' => '',
    //         'taxPayerAddress3' => '',
    //         'taxPayerCity' => 'JAKARTA',
    //         'NOP' => '',
    //         'MAPCode' => '411122',
    //         'depositTypeCode' => '100',
    //         'wajibPungutNPWP' => '',
    //         'wajibPungutName' => '',
    //         'wajibPungutAddress1' => '',
    //         'wajibPungutAddress2' => '',
    //         'wajibPungutAddress3' => '',
    //         'participantId' => '',
    //         'assessmentTaxNumber' => '',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '2000000',
    //         'monthFrom' => '12',
    //         'monthTo' => '12',
    //         'year' => '2020',
    //         'confirmNumber' => '0',
    //         'traceId' => '',
    //         'kelurahan' => '',
    //         'kecamatan' => '',
    //         'provinsi' => '',
    //         'kota' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_npwp()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryNPWP([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'npwp' => '312312309013000',
    //         'NOP' => '',
    //         'MAPCode' => '411211',
    //         'depositTypeCode' => '100',
    //         'currency' => 'IDR'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_inhouse_and_va_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryInhouseAndVABeneficiaryName([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'accountNo' => '113183203'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_llg_rtgs_online_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryLLG_RTGS_OnlineBeneficiaryName([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'beneficiaryAccountNo' => '10541448',
    //         'beneficiaryBankCode' => '014'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_account_statement()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryAccountStatement([
    //         'corporateId' => 'BNI',
    //         'userId' => 'BNI_MAKER4',
    //         'fromDate' => '20240429',
    //         'toDate' => '20240429',  
    //         'transactionType' => 'All',
    //         'accountList' => [
    //             '108098391'
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_billing()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryBilling([
    //         'corporateId' => 'BNI',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'institution' => 'MPN',
    //         'customerInformation1' => '172837627222376',
    //         'customerInformation2' => '',
    //         'customerInformation3' => '',
    //         'customerInformation4' => '',
    //         'customerInformation5' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bni_pops_cash_and_carry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryBniPopsCashAndCarry([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitAccountNo' => '108098391',
    //         'salesOrganizationCode' => '2201',
    //         'distributionChannelCode' => '10',
    //         'productCode' => '04',
    //         'shipTo' => '700258',
    //         'debitOrCreditNoteNo' => '',
    //         'productInformationDetail' => [
    //             [
    //                 'materialCode' => 'A040900001',
    //                 'trip' => '1',
    //                 'quantity' => '8',
    //                 'deliveryDate' => '20240228',
    //                 'transportir' => ''
    //             ]
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bni_pops_product_allocation()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryBniPopsProductAllocation([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitAccountNo' => '108098391',
    //         'salesOrganizationCode' => '2201',
    //         'distributionChannelCode' => '10',
    //         'productCode' => '04',
    //         'shipTo' => '112312',
    //         'scheduleAggreementNo' => '124379',
    //         'debitOrCreditNoteNo' => '123456789012346789',
    //         'productInformationDetail' => [
    //             [
    //                 'materialCode' => 'A040900001',
    //                 'trip' => '1',
    //                 'quantity' => '1',
    //                 'deliveryDate' => '20240228',
    //                 'transportir' => 'AAA'
    //             ]
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_get_payment_status()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->getPaymentStatus([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'transactionReferenceNo' => '20240227083050233689',
    //         'remitterReferenceNo' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inhouse_transfer()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inhouseTransfer([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '100',
    //         'treasuryReferenceNo' => '',
    //         'transactionPurposeCode' => '',
    //         'remark1' => 'IH-TRF-RMK1',
    //         'remark2' => 'IH-TRF-RMK2',
    //         'remark3' => 'IH-TRF-RMK3',
    //         'remitterReferenceNo' => 'REM20230704IHKG',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'BEN20230704IHKG',
    //         'toAccountNo' => '115208364',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'wide.uatbeneficiary@gmail.com',
    //         'transactionInstructionDate' => '20240227',
    //         'docUniqueId' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_LLG()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->transferLLG([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '960000',
    //         'treasuryReferenceNo' => '',
    //         'chargeTo' => 'OUR',
    //         'remark1' => 'LLG-RMK1',
    //         'remark2' => 'LLG-RMK2',
    //         'remark3' => 'LLG-RMK3',
    //         'remitterReferenceNo' => 'REM20226RLLG5O8',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'BEN20226RLLG18',
    //         'beneficiaryAccountNo' => '111282623',
    //         'beneficiaryAccountName' => 'PAK BUDI',
    //         'beneficiaryAddress1' => 'BENE ADDRESS1',
    //         'beneficiaryAddress2' => 'BENE ADDRESS2',
    //         'beneficiaryAddress3' => 'BENE ADDRESS3',
    //         'beneficiaryResidentshipCountryCode' => 'AT',
    //         'beneficiaryCitizenshipCountryCode' => 'AT',
    //         'beneficiaryType' => '1',
    //         'beneficiaryBankCode' => 'CENAIDJA',
    //         'beneficiaryBankName' => 'BANK CENTRAL ASIA',
    //         'beneficiaryBankBranchCode' => '0391',
    //         'beneficiaryBankBranchName' => '',
    //         'beneficiaryBankCityName' => 'WIL. KOTA JAKARTA PUSAT',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'wide.uatbeneficiary@gmail.com',
    //         'transactionInstructionDate' => '20240724'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_RTGS()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->transferRTGS([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '100050000',
    //         'treasuryReferenceNo' => '',
    //         'chargeTo' => 'OUR',
    //         'remark1' => 'RTGS-RMK1',
    //         'remark2' => 'RTGS-RMK2',
    //         'remark3' => 'RTGS-RMK3',
    //         'remitterReferenceNo' => 'REM20221RTGS07E4',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'BEN20221RTGS07E4',
    //         'beneficiaryAccountNo' => '10529373',
    //         'beneficiaryAccountName' => 'PAK CHANDRA',
    //         'beneficiaryAddress1' => 'BENE ADD 1',
    //         'beneficiaryAddress2' => 'BENE ADD 2',
    //         'beneficiaryAddress3' => 'BENE ADD 3',
    //         'beneficiaryResidentshipCountryCode' => 'ID',
    //         'beneficiaryCitizenshipCountryCode' => 'ID',
    //         'beneficiaryBankCode' => 'CENAIDJA',
    //         'beneficiaryBankName' => 'BANK CENTRAL ASIA',
    //         'beneficiaryBankBranchCode' => '0391',
    //         'beneficiaryBankBranchName' => '',
    //         'beneficiaryBankCityName' => 'WIL. KOTA JAKARTA PUSAT',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'wide.uatbeneficiary@gmail.com',
    //         'transactionInstructionDate' => '20240724'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_online()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->transferOnline([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '860000',
    //         'treasuryReferenceNo' => '',
    //         'chargeTo' => 'OUR',
    //         'remark1' => 'OT-RMK1',
    //         'remark2' => 'OT-RMK2',
    //         'remark3' => 'OT-RMK3',
    //         'remitterReferenceNo' => 'REM2022090OT54',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'BEN2022090OT54',
    //         'beneficiaryAccountNo' => '773723561',
    //         'beneficiaryBankCode' => '014',
    //         'beneficiaryBankName' => 'BANK SULUTGO',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'wide.uatbeneficiary@gmail.com',
    //         'transactionInstructionDate' => '20240724'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_international()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->transferInternational([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '315592342',
    //         'amountCurrency' => 'USD',
    //         'amount' => '100.55',
    //         'treasuryReferenceNo' => '',
    //         'chargeTo' => 'OUR',
    //         'remark1' => 'INT TRF RMK1',
    //         'remark2' => 'INT TRF RMK2',
    //         'remark3' => 'INT TRF RMK3',
    //         'remitterReferenceNo' => 'REMHYUD200T456',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'REMHYUD00F456',
    //         'beneficiaryAccountNo' => '1000551267',
    //         'beneficiaryAccountName' => 'Janifree',
    //         'beneficiaryAddress1' => 'MUNICH',
    //         'beneficiaryAddress2' => 'GERMANY',
    //         'beneficiaryAddress3' => '',
    //         'organizationDirectoryCode' => 'BIC',
    //         'beneficiaryBankCode' => 'ABBYGB2LXXX',
    //         'beneficiaryBankName' => 'ABBEY NATIONALE PLC. - LONDON',
    //         'beneficiaryBankBranchName' => '',
    //         'beneficiaryBankAddress1' => '',
    //         'beneficiaryBankAddress2' => '',
    //         'beneficiaryBankAddress3' => '',
    //         'beneficiaryBankCountryName' => 'GERMANY',
    //         'correspondentBankName' => '',
    //         'identicalStatusFlag' => 'N',
    //         'beneficiaryResidentshipCode' => 'ID',
    //         'beneficiaryCitizenshipCode' => 'ID',
    //         'beneficiaryCategoryCode' => 'C9',
    //         'transactorRelationship' => 'Y',
    //         'transactionPurposeCode' => '2012',
    //         'transactionDescription' => 'TRX DESC',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'janifree.aprisma@gmail.com',
    //         'transactionInstructionDate' => '20240724',
    //         'docUniqueId' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_billing_payment()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->billingPayment([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'institution' => 'MPN',
    //         'payeeName' => 'MPN',
    //         'customerInformation1' => '172837627222376',
    //         'customerInformation2' => '',
    //         'customerInformation3' => '',
    //         'customerInformation4' => '',
    //         'customerInformation5' => '',
    //         'billPresentmentFlag' => 'N',
    //         'remitterRefNo' => 'REMYUBGEYVFT',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryRefNo' => 'BENYUBGEYVFEE',
    //         'notificationFlag' => 'Y',
    //         'beneficiaryEmail' => 'janifree.aprisma@gmail.com',
    //         'transactionInstructionDate' => '20240227',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '100000'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_bni_pops_cash_and_carry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->bniPopsCashAndCarry([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitAccountNo' => '108098391',
    //         'salesOrganizationCode' => '2201',
    //         'distributionChannelCode' => '10',
    //         'productCode' => '04',
    //         'shipTo' => '700075',
    //         'debitOrCreditNoteNo' => '',
    //         'productInformationDetail' => [
    //             [
    //                 'materialCode' => 'A040900001',
    //                 'trip' => '10',
    //                 'quantity' => '2',
    //                 'deliveryDate' => '20240228',
    //                 'transportir' => ''
    //             ]
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    public function test_bni_pops_product_allocation()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->bniPopsProductAllocation([
            'corporateId' => 'BNI_UAT',
            'userId' => 'BNI_MAKER4',
            'debitAccountNo' => '108098391',
            'salesOrganizationCode' => '2201',
            'distributionChannelCode' => '10',
            'productCode' => '04',
            'shipTo' => '701759',
            'scheduleAggreementNo' => '124365',
            'debitOrCreditNoteNo' => '',
            'productInformationDetail' => [
                [
                    'materialCode' => 'A040900001',
                    'trip' => '10',
                    'quantity' => '2',
                    'deliveryDate' => '20240228',
                    'transportir' => 'AAA'
                ],
                [
                    'materialCode' => 'A040900001',
                    'trip' => '15',
                    'quantity' => '2',
                    'deliveryDate' => '20240228',
                    'transportir' => 'AAA'
                ]
            ]
        ]);
        $this->assertEquals($response->requestStatus, '0');
    }

    // public function test_bni_pops_resubmit_cash_and_carry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->bniPopsResubmitCashAndCarry([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'transactionReferenceNo' => '',
    //         'SONumber' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_pops_resubmit_product_allocation()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->bniPopsResubmitProductAllocation([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'transactionReferenceNo' => '202402261600016789',
    //         'SONumber' => ''
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_create_virtual_account()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->createVirtualAccount([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'companyCode' => '7775',
    //         'virtualAccountNo' => '819283746658',
    //         'virtualAccountName' => 'VA Test 1',
    //         'virtualAccountTypeCode' => '2',
    //         'billingAmount' => '800000',
    //         'varAmount1' => '200000',
    //         'varAmount2' => '120000',
    //         'expiryDate' => '20240228',
    //         'expiryTime' => '11:09:07',
    //         'mobilePhoneNo' => '08432432432',
    //         'statusCode' => '1'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_update_virtual_account()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->updateVirtualAccount([
    //         'corporateId' => 'BNI',
    //         'userId' => 'BNI_MAKER4',
    //         'companyCode' => '7775',
    //         'virtualAccountNo' => '7775129284933441',
    //         'virtualAccountName' => 'VA Test WTI',
    //         'virtualAccountTypeCode' => '2',
    //         'billingAmount' => '800000',
    //         'varAmount1' => '200000',
    //         'varAmount2' => '120000',
    //         'expiryDate' => '20240228',
    //         'expiryTime' => '10:10:10',
    //         'mobilePhoneNo' => '08432432432',
    //         'statusCode' => '2'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_inquiry_virtual_account_transaction()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryVirtualAccountTransaction([
    //         'corporateId' => 'BNI',
    //         'userId' => 'BNI_MAKER4',
    //         'virtualAccountNo' => '7775129284933441',
    //         'fromDate' => '20230101',
    //         'toDate' => '20240226'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bulk_get_status()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->bulkGetStatus([
    //         'corporateId' => 'BNI',
    //         'userId' => 'BNI_MAKER4',
    //         'fileRefNo' => '20230616103436758',
    //         'apiRefNo' => 'ALL_MIXAG'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_balance_inquiry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->balanceInquiry([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'accountList' => [
    //             '1000507841'
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_forex_rate()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryForexRate([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'currencyList' => [
    //             'USD',
    //             'EUR'
    //         ]
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_bulk_payment_mixed()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->bulkPaymentMixed([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'apiRefNo' => 'BLKTRX027FEB2024000003',
    //         'instructionDate' => '20240227',
    //         'session' => '',
    //         'serviceType' => 'MXD',
    //         'debitAcctNo' => '',
    //         'amount' => '',
    //         'currency' => '',
    //         'chargeTo' => '',
    //         'residenceCode' => '',
    //         'citizenCode' => '',
    //         'category' => '',
    //         'transactionType' => 'D',
    //         'accountNmValidation' => 'Y',
    //         'remark' => 'BULK PAYMENT MXD',
    //         'childContent' => "10530752,Nisa,450,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,,,,,,,,,,,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIXKFGZTQFF,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IHT,IDR,125028118,OUR,ID,,C9,|@|10530752,Meidina,4000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,014,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIVGZVBFTD1,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,OT,IDR,10529373,OUR,ID,ID,C9,|@|10530752,Ulfa,15000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,CENAIDJA,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIBGYBGXTEL8,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,LLG,IDR,10547564,OUR,ID,ID,C9,|@|10530752,Ulfa,15000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,CENAIDJA,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIBGYBGXTEL8,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,RTGS,IDR,10547564,OUR,ID,ID,C9,|@|10541448,Hanna,250,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,BIC|ABBYGB2LXXX,ABBEY NATIONALE PLC,Westfield,Ariel Way,Shepherd's Bush,London W12 7GF,London,United Kingdom,GB,GB,wide.uatbeneficiary@gmail.com,085317773020,021771881,Standard Chartered,01,N,N,C9,LLD Desc International,REMJGQVFLZT7,N,BENITGLFHB,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IFT,USD,116954537,OUR,GB,GB,C9,"
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_payroll_mixed()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->payrollMixed([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'apiRefNo' => 'PROLLTRX028FEB2024007',
    //         'serviceType' => 'MXD',
    //         'instructionDate' => '20240228',
    //         'session' => '',
    //         'debitAcctNo' => '',
    //         'totalAmount' => '',
    //         'totalAmountCurrencyCode' => '',
    //         'chargeTo' => '',
    //         'residenceCode' => '',
    //         'citizenCode' => '',
    //         'remitterCategory' => '',
    //         'transactionType' => 'D',
    //         'remark' => 'INT only on Mixed API',
    //         'accountNmValidation' => 'Y',
    //         'totalRecord' => '',
    //         'childContent' => "10530752,Nisa,450,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,,,,,,,,,,,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIXKFGZTQFF,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IHT,IDR,108098391,OUR,ID,,C9,|@|10530752,Meidina,4000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,014,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIVGZVBFTD1,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,OT,IDR,108098391,OUR,ID,ID,C9,|@|10530752,Ulfa,15000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,CENAIDJA,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIBGYBGXTEL8,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,LLG,IDR,108098391,OUR,ID,ID,C9,|@|10530752,Ulfa,15000,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,CENAIDJA,BANK CENTRAL ASIA,BCA Org Unit Name,Gedung Tiga Roda,Sudirman,Jakarta Selatan,DKI Jakarta,Indonesia,ID,ID,wide.uatbeneficiary@gmail.com,,,,,,,,,REMIBGYBGXTEL8,N,BENITGKSCF,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,3,RTGS,IDR,108098391,OUR,ID,ID,C9,|@|10541448,Hanna,250,,Trx Remark 1,Trx Remark 2,Trx Remark 3,Bene Address 1,Bene Address 2,Bene Address 3,BIC|ABBYGB2LXXX,ABBEY NATIONALE PLC,Westfield,Ariel Way,Shepherd's Bush,London W12 7GF,London,United Kingdom,GB,GB,wide.uatbeneficiary@gmail.com,085317773020,021771881,Standard Chartered,01,N,N,C9,LLD Desc International,REMJGQVFLZT7,N,BENITGLFHB,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IFT,USD,315592342,OUR,GB,GB,C9,"
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    /* pending */
    // public function test_bni_direct_domestic_single_bi_fast_transfer()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->domesticSingleBIFastTransfer([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'debitedAccountNo' => '108098391',
    //         'amountCurrency' => 'IDR',
    //         'amount' => '500000',
    //         'exchangeRateCode' => 'Cr',
    //         'treasuryReferenceNo' => '',
    //         'chargeTo' => 'OUR',
    //         'remark1' => 'BIFast-RMK1',
    //         'remark2' => 'BIFast-RMK1',
    //         'remark3' => 'BIFast-RMK1',
    //         'remitterReferenceNo' => 'REM11OPTYERT0',
    //         'finalizePaymentFlag' => 'Y',
    //         'beneficiaryReferenceNo' => 'BEN11OPDTAS9',
    //         'usedProxy' => 'N',
    //         'beneficiaryAccountNo' => '9832132281',
    //         'proxyId' => '',
    //         'beneficiaryBankCode' => 'CENAIDJA',
    //         'beneficiaryBankName' => 'Bank BCA',
    //         'notificationFlag' => 'N',
    //         'beneficiaryEmail' => '',
    //         'transactionInstructionDate' => '20240226',
    //         'transactionPurposeCode' => '00'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bi_fast_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryBIFastBeneficiaryName([
    //         'corporateId' => 'BNI_UAT',
    //         'userId' => 'BNI_MAKER4',
    //         'usedProxy' => 'N',
    //         'beneficiaryAccountNo' => '9832132281',
    //         'proxyId' => '',
    //         'beneficiaryBankCode' => 'CENAIDJA'
    //     ]);
    //     $this->assertEquals($response->requestStatus, '0');
    // }
    /* end pending */
    
    public function test_bni_direct_single_bulk_payment()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->singleBulkPayment([
            'corporateId' => 'BNI_UAT',
            'userId' => 'BNI_MAKER4',
            'apiRefNo' => 'API-REF-BLK-X7',
            'instructionDate' => '20240226',
            'session' => '1',
            'serviceType' => 'SBMXD',
            'isSTP' => 'N',
            'transactionType' => 'D',
            'remark' => 'Single To Bulk Payment Mixed From API',
            'accountNmValidation' => 'N',
            'transactionDetail' => [
                [
                    'creditAcctNo' => '114479721',
                    'creditAcctNm' => 'BULOG4',
                    'amount' => '100',
                    'treasury' => '',
                    'remark1' => 'RMK1',
                    'remark2' => 'RMK2',
                    'remark3' => 'RMK3',
                    'benAddr1' => 'BENADDR1',
                    'benAddr2' => 'BENADDR2',
                    'benAddr3' => 'BENADDR3',
                    'benBankCode' => 'BIC|ABBYGB2LXXX',
                    'benBankNm' => 'Abbey National',
                    'benBranchNm' => 'Abbey National Branch 2 Triton Square',
                    'benBankAddr1' => 'BENBANKADDR1',
                    'benBankAddr2' => 'BENBANKADDR2',
                    'benBankAddr3' => 'BENBANKADDR3',
                    'benBankCityNm' => 'BENBANKCITY',
                    'benBankCountryNm' => 'United Kingdom',
                    'benResidenceCd' => 'GB',
                    'benCountryCd' => 'GB',
                    'benEmail' => 'wide.uatbeneficiary@gmail.com',
                    'benPhone' => '085232323',
                    'benFax' => '',
                    'correspondentBank' => '',
                    'purposeCode' => '2012',
                    'affiliate' => 'N',
                    'identical' => 'N',
                    'benCategory' => 'C9',
                    'lldDescription' => 'LLDDESC',
                    'orderPartyRefNo' => 'REM77812HYFRK',
                    'finalizePayment' => 'N',
                    'counterPartyRefNo' => 'BEN77812HYFRK',
                    'extraDetail1' => 'EXTDET1',
                    'extraDetail2' => 'EXTDET2',
                    'extraDetail3' => 'EXTDET3',
                    'extraDetail4' => 'EXTDET4',
                    'extraDetail5' => 'EXTDET5',
                    'typeCode' => '',
                    'mixedServiceCode' => 'IFT',
                    'mixedCurrency' => 'USD',
                    'mixedDebitAcctNo' => '315592342',
                    'mixedChargeTo' => 'OUR',
                    'mixedRemCountryCode' => 'ID',
                    'mixedRemCitizenCode' => 'ID',
                    'mixedRemCategory' => 'C9',
                    'proxyId' => '',
                    'proxyFlag' => ''
                ]
            ]
        ]);
        $this->assertEquals($response->requestStatus, '0');
    }

    public function test_bni_direct_single_payroll()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->singlePayroll([
            'corporateId' => 'BNI_UAT',
            'userId' => 'BNI_MAKER4',
            'apiRefNo' => 'API-REF-PROLL-G9',
            'instructionDate' => '20240719',
            'session' => '1',
            'serviceType' => 'SPMXD',
            'isSTP' => 'N',
            'transactionType' => 'D',
            'remark' => 'Single To Payroll Mixed From API',
            'accountNmValidation' => 'N',
            'transactionDetail' => [
                [
                    'creditAcctNo' => '114479721',
                    'creditAcctNm' => 'BULOG4',
                    'amount' => '100',
                    'treasury' => '',
                    'remark1' => 'RMK1',
                    'remark2' => 'RMK2',
                    'remark3' => 'RMK3',
                    'benAddr1' => 'BENADDR1',
                    'benAddr2' => 'BENADDR2',
                    'benAddr3' => 'BENADDR3',
                    'benBankCode' => 'BIC|ABBYGB2LXXX',
                    'benBankNm' => 'Abbey National',
                    'benBranchNm' => 'Abbey National Branch 2 Triton Square',
                    'benBankAddr1' => 'BENBANKADDR1',
                    'benBankAddr2' => 'BENBANKADDR2',
                    'benBankAddr3' => 'BENBANKADDR3',
                    'benBankCityNm' => 'BENBANKCITY',
                    'benBankCountryNm' => 'United Kingdom',
                    'benResidenceCd' => 'GB',
                    'benCountryCd' => 'GB',
                    'benEmail' => 'wide.uatbeneficiary@gmail.com',
                    'benPhone' => '085232323',
                    'benFax' => '',
                    'correspondentBank' => '',
                    'purposeCode' => '2012',
                    'affiliate' => 'N',
                    'identical' => 'N',
                    'benCategory' => 'C9',
                    'lldDescription' => 'LLDDESC',
                    'orderPartyRefNo' => 'REM77812ABCD',
                    'finalizePayment' => 'N',
                    'counterPartyRefNo' => 'REM77812ABCD',
                    'extraDetail1' => 'EXTDET1',
                    'extraDetail2' => 'EXTDET2',
                    'extraDetail3' => 'EXTDET3',
                    'extraDetail4' => 'EXTDET4',
                    'extraDetail5' => 'EXTDET5',
                    'typeCode' => '',
                    'mixedServiceCode' => 'IFT',
                    'mixedCurrency' => 'USD',
                    'mixedDebitAcctNo' => '315592342',
                    'mixedChargeTo' => 'OUR',
                    'mixedRemCountryCode' => 'ID',
                    'mixedRemCitizenCode' => 'ID',
                    'mixedRemCategory' => 'C9',
                    'proxyId' => '',
                    'proxyFlag' => ''
                ]
            ]
        ]);
        $this->assertEquals($response->requestStatus, '0');
    }

    public function test_bni_direct_single_bulk_payment_submit()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->singleBulkPaymentSubmit([
            'corporateId' => 'BNI_UAT',
            'userId' => 'BNI_MAKER4',
            'apiRefNo' => 'API-REF-BLK-Y0'
        ]);
        $this->assertEquals($response->requestStatus, '0');
    }
    
    public function test_bni_direct_single_payroll_submit()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->singlePayrollSubmit([
            'corporateId' => 'BNI_UAT',
            'userId' => 'BNI_MAKER4',
            'apiRefNo' => 'API-REF-PROLL-Y0'
        ]);
        $this->assertEquals($response->requestStatus, '0');
    }

}

?>