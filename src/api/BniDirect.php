<?php

namespace BniApi\BniPhp\api;

use BniApi\BniPhp\Bni;
use BniApi\BniPhp\net\HttpClient;
use BniApi\BniPhp\utils\Util;
use createMPNG2BillingService;
use inquiryAccountStatementService;
use inquiryBillingService;
use inquiryBniPopsCashAndCarryService;
use inquiryInhouseAndVABeneficiaryNameService;
use inquiryLLG_RTGS_OnlineBeneficiaryNameService;
use inquiryNPWPService;
use bniPopsCashAndCarryService;
use bniPopsProductAllocationService;
use bniPopsResubmitCashAndCarryService;
use bniPopsResubmitProductAllocationService;
use bulkGetStatusService;
use createVirtualAccountService;
use updateVirtualAccountService;
use balanceInquiry;
use domesticSingleBIFastTransfer;
use inquiryForexRate;
use inquiryBIFastBeneficiaryName;
use bulkPaymentMixed;
use payrollMixed;
use billingPayment;
use getPaymentStatus;
use inhouseTransfer;
use inquiryBniPopsProductAllocation;
use transferInternational;
use transferLLG;
use transferOnline;
use transferRTGS;
use inquiryVirtualAccountTransaction;
use singleBulkPayment;
use singlePayroll;
use singleBulkPaymentSubmit;
use singlePayrollSubmit;

require_once('src/api/BniDirectService/createMPNG2Billing.php');
require_once('src/api/BniDirectService/inquiryNPWP.php');
require_once('src/api/BniDirectService/inquiryInhouseAndVABeneficiaryName.php');
require_once('src/api/BniDirectService/inquiryLLG_RTGS_OnlineBeneficiaryName.php');
require_once('src/api/BniDirectService/inquiryAccountStatement.php');
require_once('src/api/BniDirectService/inquiryBilling.php');
require_once('src/api/BniDirectService/inquiryBniPopsCashAndCarry.php');
require_once('src/api/BniDirectService/bniPopsCashAndCarry.php');
require_once('src/api/BniDirectService/bniPopsProductAllocation.php');
require_once('src/api/BniDirectService/bniPopsResubmitCashAndCarry.php');
require_once('src/api/BniDirectService/bniPopsResubmitProductAllocation.php');
require_once('src/api/BniDirectService/bulkGetStatus.php');
require_once('src/api/BniDirectService/createVirtualAccount.php');
require_once('src/api/BniDirectService/updateVirtualAccount.php');
require_once('src/api/BniDirectService/balanceInquiry.php');
require_once('src/api/BniDirectService/domesticSingleBIFastTransfer.php');
require_once('src/api/BniDirectService/inquiryForexRate.php');
require_once('src/api/BniDirectService/inquiryBIFastBeneficiaryName.php');
require_once('src/api/BniDirectService/bulkPaymentMixed.php');
require_once('src/api/BniDirectService/payrollMixed.php');
require_once('src/api/BniDirectService/billingPayment.php');
require_once('src/api/BniDirectService/getPaymentStatus.php');
require_once('src/api/BniDirectService/inhouseTransfer.php');
require_once('src/api/BniDirectService/inquiryBniPopsProductAllocation.php');
require_once('src/api/BniDirectService/transferInternational.php');
require_once('src/api/BniDirectService/transferLLG.php');
require_once('src/api/BniDirectService/transferOnline.php');
require_once('src/api/BniDirectService/transferRTGS.php');
require_once('src/api/BniDirectService/inquiryVirtualAccountTransaction.php');
require_once('src/api/BniDirectService/singleBulkPayment.php');
require_once('src/api/BniDirectService/singlePayroll.php');
require_once('src/api/BniDirectService/singleBulkPaymentSubmit.php');
require_once('src/api/BniDirectService/singlePayrollSubmit.php');

class BNIDirect {
    use createMPNG2BillingService;
    use inquiryNPWPService;
    use inquiryInhouseAndVABeneficiaryNameService;
    use inquiryLLG_RTGS_OnlineBeneficiaryNameService;
    use inquiryAccountStatementService;
    use inquiryBillingService;
    use inquiryBniPopsCashAndCarryService;
    use bniPopsCashAndCarryService;
    use bniPopsProductAllocationService;
    use bniPopsResubmitCashAndCarryService;
    use bniPopsResubmitProductAllocationService;
    use bulkGetStatusService;
    use createVirtualAccountService;
    use updateVirtualAccountService;
    use balanceInquiry;
    use domesticSingleBIFastTransfer;
    use inquiryForexRate;
    use inquiryBIFastBeneficiaryName;
    use bulkPaymentMixed;
    use payrollMixed;
    use billingPayment;
    use getPaymentStatus;
    use inhouseTransfer;
    use inquiryBniPopsProductAllocation;
    use transferInternational;
    use transferLLG;
    use transferOnline;
    use transferRTGS;
    use inquiryVirtualAccountTransaction;
    use singleBulkPayment;
    use singlePayroll;
    use singleBulkPaymentSubmit;
    use singlePayrollSubmit;
    
    protected $httpClient;
    protected $utils;
    protected $bni;
    protected $bniDirectApiKey;

    function __construct(Bni $bni, string $bniDirectApiKey)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
        $this->bniDirectApiKey = $bniDirectApiKey;
    }

    private function generateBniDirectKey(string $corporateId, string $userId){
        $data = strtolower($corporateId).strtolower($userId).$this->bniDirectApiKey;
        $encrypData = hash('sha256', $data);
        
        return strtolower($encrypData);
    }

    protected function requestBNIDirect($url, $dataJson, $data ) {
        $time = $this->utils->getTimeStamp();
        $header = [
            'Authorization' => 'Bearer ' . $this->bni->getToken($version= '1.1'),
            'X-API-Key' => $this->bni->apiKey,
            'bnidirect-api-key' => $this->generateBniDirectKey($data['corporateId'], $data['userId']),
            'X-Signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'X-Timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }
}
 ?>