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
            $env = 'sandbox-2',
            $clientId = $credentials->api_services->clientId,
            $clientSecret = $credentials->api_services->clientSecret,
            $apiKey = $credentials->api_services->apiKey,
            $apiSecret = $credentials->api_services->apiSecret,
            $appName = $credentials->api_services->appName
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
    //     $bniDirect = $this->BniDirect($bni);
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
    public function test_bni_direct_inquiry_inhouse_and_va_beneficiary_name()
    {
        $bni = $this->init();
        $bniDirect = $this->BniDirect($bni);
        $response = $bniDirect->inquiryInhouseAndVABeneficiaryName('companymb','jenomaker','113183203');
        $this->assertEquals($response->requestStatus, '0');
    }

    /* success */
    // public function test_bni_direct_inquiry_llg_rtgs_online_beneficiary_name()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
    //     $response = $bniDirect->inquiryLLG_RTGS_OnlineBeneficiaryName(
    //         $corporateId =  'companymb' ,
    //         $userId =  'jenomaker' ,
    //         $beneficiaryAccountNo =  '10541448' ,
    //         $beneficiaryBankCode =  '002' 
    //     );
    //     $this->assertEquals($response->requestStatus, '0');
    // }

    // public function test_bni_direct_inquiry_account_statement()
    // {
    //     $bni = $this->init();
    //     $bniDirect = $this->BniDirect($bni);
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
    //     $bniDirect = $this->BniDirect($bni);
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
    //     $bniDirect = $this->BniDirect($bni);
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
}

?>