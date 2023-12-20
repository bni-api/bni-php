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
            $env = 'dev-2',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName
        );
    }

    // public function test_bni_direct_create_mpng2_billing_id()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->createMPNG2Billing(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $npwp= '111929199928123',
    //         $taxPayerName= 'NAMA NPWP',
    //         $taxPayerAddress1= 'ALAMAT 1',
    //         $taxPayerAddress2= '',
    //         $taxPayerAddress3= '',
    //         $taxPayerCity= 'JAKARTA',
    //         $NOP= '',
    //         $MAPCode= '411122',
    //         $depositTypeCode= '111',
    //         $wajibPungutNPWP= '',
    //         $wajibPungutName= '',
    //         $wajibPungutAddress1= '',
    //         $wajibPungutAddress2= '',
    //         $wajibPungutAddress3= '',
    //         $participantId= '111828293938',
    //         $assessmentTaxNumber= '',
    //         $amountCurrency= 'IDR',
    //         $amount= '100000',
    //         $monthFrom= '01',
    //         $monthTo= '12',
    //         $year= '2019'
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_npwp()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryNPWP(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $npwp= '111822839281234',
    //         $NOP= '',
    //         $MAPCode= '411112',
    //         $depositTypeCode= '123',
    //         $currency= 'USD'
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    /* success */
    // public function test_bni_direct_inquiry_inhouse_and_va_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryInhouseAndVABeneficiaryName('BNI_SIT','WTI_MAKER1','113183203');
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    /* success */
    // public function test_bni_direct_inquiry_llg_rtgs_online_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryLLG_RTGS_OnlineBeneficiaryName(
    //         $corporateId =  'BNI_SIT' ,
    //         $userId =  'WTI_MAKER1' ,
    //         $beneficiaryAccountNo =  '10541448' ,
    //         $beneficiaryBankCode =  '002' 
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_account_statement()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryAccountStatement(
    //         $corporateId  =  'BNI_SIT' ,
    //         $userId  =  'WTI_MAKER1' ,
    //         $fromDate  =  '20220328' ,
    //         $toDate  =  '20190903' ,
    //         $transactionType  =  'All' ,
    //         $accountList  = ['113183203' ,'115208364'] 
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_billing()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryBilling(
    //         $corporateId = 'BNI_SIT' ,
    //         $userId = 'WTI_MAKER1' ,
    //         $debitedAccountNo = '115208364' ,
    //         $institution = 'MPN' ,
    //         $customerInformation1 = '11129192812818' ,
    //         $customerInformation2 = '0316031099' ,
    //         $customerInformation3 =  '',
    //         $customerInformation4 =  '',
    //         $customerInformation5 =  ''
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bni_pops_cash_and_carry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryBniPopsCashAndCarry(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $debitAccountNo= '115208364',
    //         $salesOrganizationCode= '1003',
    //         $distributionChannelCode= '10',
    //         $productCode= '00',
    //         $shipTo= '1123123',
    //         $debitOrCreditNoteNo= 123231,
    //         $materialCode= 'A040900001',
    //         $trip= '1123123',
    //         $quantity= '100',
    //         $deliveryDate= '20190913',
    //         $transportir= ''
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_balance_inquiry()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->balanceInquiry(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $accountList= ["116952891","4447"],
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_domestic_single_bi_fast_transfer()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->domesticSingleBIFastTransfer(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $debitedAccountNo= '1000599764',
    //         $amountCurrency= 'IDR',
    //         $amount= '500000',
    //         $exchangeRateCode= 'Cr',
    //         $treasuryReferenceNo= '',
    //         $chargeTo= 'OUR',
    //         $remark1= 'BIFast-RMK1',
    //         $remark2= 'BIFast-RMK1',
    //         $remark3= 'BIFast-RMK1',
    //         $remitterReferenceNo= 'AQYBI2103202314',
    //         $finalizePaymentFlag= 'Y',
    //         $beneficiaryReferenceNo= 'BENGTYRSD110',
    //         $usedProxy= 'N',
    //         $beneficiaryAccountNo= '9832132281',
    //         $proxyId= '',
    //         $beneficiaryBankCode= 'BBBAIDJA',
    //         $beneficiaryBankName= 'Bank Permata',
    //         $notificationFlag= 'N',
    //         $beneficiaryEmail= '',
    //         $transactionInstructionDate= '20231121',
    //         $transactionPurposeCode= '01'
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_forex_rate()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryForexRate(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $currencyList= ["IDR","USD"],
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }
    
    // public function test_bni_direct_inquiry_child_account()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryForexRate(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $currencyList= ["IDR","USD"],
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_callback_api()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->callbackApi(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $apiRefNo= '2324dab653f',
    //         $status= 'Executed Successfully',
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bi_fast_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryBIFastBeneficiaryName(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $usedProxy= 'N',
    //         $beneficiaryAccountNo= '9832132281',
    //         $proxyId= '',
    //         $beneficiaryBankCode= 'BBBAIDJA',
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_bulk_payment_mixed()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->bulkPaymentMixed(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $apiRefNo= 'TRX029SEPT23009971301',
    //         $instructionDate= '20230929',
    //         $session= '',
    //         $serviceType= 'MXD',
    //         $debitAcctNo= '',
    //         $amount= '',
    //         $currency= '',
    //         $chargeTo= '',
    //         $residenceCode= '',
    //         $citizenCode= '',
    //         $category= '',
    //         $transactionType= 'D',
    //         $accountNmValidation= 'Y',
    //         $remark= 'BULK PAYMENT MXD',
    //         $childContent= '9832132281,NAMA ILMPPJTNU,100001,,REMARK1-HWBM,REMARK2-YFFW,REMARK3-UNBJ,Bene Address 1,Bene Address 2,Bene Address 3,BBBAIDJA,Bank Permata,Bank Permata|Branch Jl. Kapten Tendean 12-14A,Jl. Kapten Tendean 12-14A,Jakarta 12790,Jakarta Selatan,Jakarta,Indonesia,ID,ID,wide.beneficiary@gmail.com,,,,,,,,,REM70587148UDMW,Y,BEN70587148UDMW,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,BF,IDR,108098391,OUR,ID,ID,C9,N,N,085317773020,01'
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_payroll_mixed()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->payrollMixed(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $apiRefNo= 'YXX029SEPT2300997131',
    //         $instructionDate= '20230929',
    //         $session= '',
    //         $serviceType= 'MXD',
    //         $debitAcctNo= '',
    //         $amount= '',
    //         $currency= '',
    //         $chargeTo= '',
    //         $residenceCode= '',
    //         $citizenCode= '',
    //         $category= '',
    //         $transactionType= 'D',
    //         $accountNmValidation= 'Y',
    //         $remark= 'BULK PAYMENT MXD',
    //         $childContent= "889213621,NAMA SWQUTGLHR,101,,REMARK1-IGTE,REMARK2-QEZQ,REMARK3-TYXH,Bene Address 1,Bene Address 2,Bene Address 3,,,,,,,,,,,wide.beneficiary@gmail.com,,,,2012,,,,,REM38060584AHIQ,Y,BEN38060584AHIQ,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IHT,IDR,108098391,OUR,ID,ID,C9,N,,,|@|889213622,NAMA VONGVHDPW,100002,,REMARK1-TLHU,REMARK2-RNWB,REMARK3-BOYN,Bene Address 1,Bene Address 2,Bene Address 3,BRINIDJA,Bank Raykat Indonesia,Bank Raykat Indonesia|Branch Jl. M.H Thamrin No. 1,Jl. M.H Thamrin No. 1,Jakarta 10310,Jakarta Pusat,Jakarta,Indonesia,ID,ID,wide.beneficiary@gmail.com,,,,,,,,,REM67021138WHQM,Y,BEN67021138WHQM,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,2,LLG,IDR,108098391,OUR,ID,ID,C9,N,,,|@|889213623,NAMA CFOJGYSCN,100000002,,REMARK1-JIEV,REMARK2-EPMP,REMARK3-ZXFR,Bene Address 1,Bene Address 2,Bene Address 3,BRINIDJA,Bank Raykat Indonesia,Bank Raykat Indonesia|Branch Jl. M.H Thamrin No. 1,Jl. M.H Thamrin No. 1,Jakarta 10310,Jakarta Pusat,Jakarta,Indonesia,ID,ID,wide.beneficiary@gmail.com,,,,,,,,,REM53427300BHQC,Y,BEN53427300BHQC,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,RTGS,IDR,108098391,OUR,ID,ID,C9,N,,,|@|889213624,NAMA YPEGAUEUJ,100003,,REMARK1-NXHV,REMARK2-DMNV,REMARK3-RNMI,Bene Address 1,Bene Address 2,Bene Address 3,002,Bank Raykat Indonesia,Bank Raykat Indonesia|Branch Jl. M.H Thamrin No. 1,Jl. M.H Thamrin No. 1,Jakarta 10310,Jakarta Pusat,Jakarta,Indonesia,ID,ID,wide.beneficiary@gmail.com,,,,,,,,,REM87661139PXGR,Y,BEN87661139PXGR,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,OT,IDR,108098391,OUR,ID,ID,C9,N,,,|@|1150007270863,NAMA TAQMEAMLE,100001,,REMARK1-UZAB,REMARK2-RXWS,REMARK3-UWPS,Bene Address 1,Bene Address 2,Bene Address 3,BMRIIDJA,BANK MANDIRI,BANK MANDIRI BRANCH,Jl. Kapten Tendean 12-14A,Jakarta 12790,Jakarta Selatan,Jakarta,Indonesia,ID,ID,wide.beneficiary@gmail.com,,,,,,,,,REM96734911GLBT,Y,BEN96734911GLBT,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,BF,IDR,108098391,OUR,ID,ID,C9,N,N,6281280533832,03|@|889213626,NAMA QVBCZETAV,102,,REMARK1-SBUR,REMARK2-URWV,REMARK3-HBSC,Bene Address 1,Bene Address 2,Bene Address 3,BIC|ABBYGB2LXXX,Abbey National,Abbey National|Branch 2 Triton Square,2 Triton Square,Regent's Place NW1 3AN,London,London,United Kingdom,ID,ID,wide.beneficiary@gmail.com,085317773020,021991826,Bank BNI,2012,N,N,C9,LLD Desc,REM61083690MDPP,Y,BEN61083690MDPP,EXDET1,EXDET2,EXDET3,EXDET4,EXDET5,,IFT,USD,108098391,OUR,ID,ID,C9,N,,,"
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_billing_payment()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->billingPayment(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $debitedAccountNo= '115208364',
    //         $institution= 'MPN',
    //         $payeeName= 'asdfasdf',
    //         $customerInformation1= '111222122212333',
    //         $customerInformation2= '',
    //         $customerInformation3= '',
    //         $customerInformation4= '',
    //         $customerInformation5= '',
    //         $billPresentmentFlag= 'N',
    //         $remitterRefNo= '1123123213',
    //         $finalizePaymentFlag= 'Y',
    //         $beneficiaryRefNo= '',
    //         $notificationFlag= 'N',
    //         $beneficiaryEmail= '',
    //         $transactionInstructionDate= "20231122",
    //         $amountCurrency= "IDR",
    //         $amount= "2000000"
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    public function test_bni_direct_get_payment_status()
    {
        $bni = $this->init();
        $bniDirect = new BNIDirect($bni);
        $response = $bniDirect->getPaymentStatus(
            $corporateId= 'BNI_SIT',
            $userId= 'WTI_MAKER1',
            $transactionReferenceNo= '20230704114212237477',
            $remitterReferenceNo= ''

        );
        $this->assertEquals($response->requestStatus, '0');
    }

    // public function test_bni_direct_inhouse_transfer()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inhouseTransfer(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $debitedAccountNo= '115208364',
    //         $amountCurrency= 'IDR',
    //         $amount= '200000',
    //         $treasuryReferenceNo= '',
    //         $transactionPurposeCode= '2012',
    //         $remark1= 'transfer inhouse',
    //         $remark2= 'api',
    //         $remark3= '',
    //         $remitterReferenceNo= '',
    //         $finalizePaymentFlag= 'N',
    //         $beneficiaryReferenceNo= '',
    //         $toAccountNo= '113183203',
    //         $notificationFlag= 'N',
    //         $beneficiaryEmail= "",
    //         $transactionInstructionDate= "20190905",
    //         $docUniqueId= ""
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_bni_pops_product_allocation()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->inquiryBniPopsProductAllocation(
    //         $corporateId= "BNI_SIT",
    //         $userId= "WTI_MAKER1",
    //         $debitAccountNo= "115208364",
    //         $salesOrganizationCode= "1002",
    //         $distributionChannelCode= "10",
    //         $productCode= "04",
    //         $shipTo= "1123123",
    //         $scheduleAggreementNo= "118282812",
    //         $debitOrCreditNoteNo= "123231",
    //         $productInformationDetail= array(
    //                         (object) array('materialCode' => 'A040900001', 'trip' => '1123123', 'quantity' => '100', 'deliveryDate' => '20231109', 'transportir' => '')
    //                     )
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_international()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->transferInternational(
    //         $corporateId= "BNI_SIT",
    //         $userId= "WTI_MAKER1",
    //         $debitedAccountNo= "1000599764",
    //         $amountCurrency= "USD",
    //         $amount= "10.55",
    //         $treasuryReferenceNo= "",
    //         $chargeTo= "OUR",
    //         $remark1= "INT TRF RMK1",
    //         $remark2= "INT TRF RMK2",
    //         $remark3= "INT TRF RMK3",
    //         $remitterReferenceNo= "UYY26092023009",
    //         $finalizePaymentFlag= "Y",
    //         $beneficiaryReferenceNo= "BENHYUDTVGAVD",
    //         $beneficiaryAccountNo= "11123123",
    //         $beneficiaryAccountName= "Janifree",
    //         $beneficiaryAddress1= "MUNICH",
    //         $beneficiaryAddress2= "GERMANY",
    //         $beneficiaryAddress3= "",
    //         $organizationDirectoryCode= "BIC",
    //         $beneficiaryBankCode= "SOGEDEFFXXX",
    //         $beneficiaryBankName= "SOCIETE GENERALE - FRANKFURT",
    //         $beneficiaryBankBranchName= "",
    //         $beneficiaryBankAddress1= "",
    //         $beneficiaryBankAddress2= "",
    //         $beneficiaryBankAddress3= "",
    //         $beneficiaryBankCountryName= "GERMANY",
    //         $correspondentBankName= "",
    //         $identicalStatusFlag= "N",
    //         $beneficiaryResidentshipCode= "ID",
    //         $beneficiaryCitizenshipCode= "ID",
    //         $beneficiaryCategoryCode= "C9",
    //         $transactorRelationship= "Y",
    //         $transactionPurposeCode= "2012",
    //         $transactionDescription= "TRX DESC",
    //         $notificationFlag= "N",
    //         $beneficiaryEmail= "",
    //         $transactionInstructionDate= "20231102",
    //         $docUniqueId= ""
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_LLG()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->transferLLG(
    //         $corporateId= "BNI_SIT",
    //         $userId= "WTI_MAKER1",
    //         $debitedAccountNo= "1000599764",
    //         $amountCurrency= "IDR",
    //         $amount= "960000",
    //         $treasuryReferenceNo= "",
    //         $chargeTo= "OUR",
    //         $remark1= "LLG-RMK1",
    //         $remark2= "LLG-RMK2",
    //         $remark3= "LLG-RMK3",
    //         $remitterReferenceNo= "UYY26092023005",
    //         $finalizePaymentFlag= "Y",
    //         $beneficiaryReferenceNo= "BEN202210LLG141",
    //         $beneficiaryAccountNo= "111282623",
    //         $beneficiaryAccountName= "PAK BUDI",
    //         $beneficiaryAddress1= "BENE ADDRESS1",
    //         $beneficiaryAddress2= "BENE ADDRESS2",
    //         $beneficiaryAddress3= "BENE ADDRESS3",
    //         $beneficiaryResidentshipCountryCode= "ID",
    //         $beneficiaryCitizenshipCountryCode= "ID",
    //         $beneficiaryType= "1",
    //         $beneficiaryBankCode= "CENAIDJA",
    //         $beneficiaryBankName= "BANK CENTRAL ASIA",
    //         $beneficiaryBankBranchCode= "0391",
    //         $beneficiaryBankBranchName= "",
    //         $beneficiaryBankCityName= "WIL. KOTA JAKARTA PUSAT",
    //         $notificationFlag= "Y",
    //         $beneficiaryEmail= "wide.uatbeneficiary@gmail.com",
    //         $transactionInstructionDate= "20231102"
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_online()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->transferOnline(
    //         $corporateId= "BNI_SIT",
    //         $userId= "WTI_MAKER1",
    //         $debitedAccountNo= "1000599764",
    //         $amountCurrency= "IDR",
    //         $amount= "86000",
    //         $treasuryReferenceNo= "",
    //         $chargeTo= "OUR",
    //         $remark1= "OT-RMK1",
    //         $remark2= "OT-RMK2",
    //         $remark3= "OT-RMK3",
    //         $remitterReferenceNo= "UYOT26092316",
    //         $finalizePaymentFlag= "Y",
    //         $beneficiaryReferenceNo= "BEN2022090OT253",
    //         $beneficiaryAccountNo= "123456789",
    //         $beneficiaryBankCode= "014",
    //         $beneficiaryBankName= "BANK BCA",
    //         $notificationFlag= "Y",
    //         $beneficiaryEmail= "wide.uatbeneficiary@gmail.com",
    //         $transactionInstructionDate= "20231102"
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_transfer_RTGS()
    // {
    //     $bni = $this->init();
    //     $bniDirect = new BNIDirect($bni);
    //     $response = $bniDirect->transferRTGS(
    //         $corporateId= 'BNI_SIT',
    //         $userId= 'WTI_MAKER1',
    //         $debitedAccountNo= "115208364",
    //         $amountCurrency= "IDR",
    //         $amount= "100000001",
    //         $treasuryReferenceNo= "",
    //         $chargeTo= "BEN",
    //         $remark1= "coba",
    //         $remark2= "rtgs",
    //         $remark3= "1",
    //         $remitterReferenceNo= "",
    //         $finalizePaymentFlag= "Y",
    //         $beneficiaryReferenceNo= "",
    //         $beneficiaryAccountNo= "11128281223",
    //         $beneficiaryAccountName= "TEST rtgs TRF",
    //         $beneficiaryAddress1= "asdfadsf",
    //         $beneficiaryAddress2= "afefef",
    //         $beneficiaryAddress3= "ddfdf",
    //         $beneficiaryResidentshipCountryCode= "ID",
    //         $beneficiaryCitizenshipCountryCode= "ID",
    //         $beneficiaryBankCode= "BMRIIDJA",
    //         $beneficiaryBankName= "BANK MANDIRI",
    //         $beneficiaryBankBranchCode= "0391",
    //         $beneficiaryBankBranchName= "adsfadf",
    //         $beneficiaryBankCityName= "jakarta pusat",
    //         $notificationFlag= "N",
    //         $beneficiaryEmail= "",
    //         $transactionInstructionDate= "20230505"
           
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

}

?>