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
    
    protected $httpClient;
    protected $utils;
    protected $bni;
    protected $bniDirectKey;

    function __construct(Bni $bni, string $bniDirectKey)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
        $this->bniDirectKey = $bniDirectKey;
    }

    private function generateBniDirectKey(string $corporateId, string $userId){
        $data = strtolower($corporateId).strtolower($userId).$this->bniDirectKey;
        $encrypData = hash('sha256', $data);
        
        return strtolower($encrypData);
    }

    protected function requestBNIDirect($url, $dataJson, $data ) {
        $time = $this->utils->getTimeStamp();
        $header = [
            'X-API-Key' => $this->bni->apiKey,
            'bnidirect-api-key' => $this->generateBniDirectKey($data['corporateId'], $data['userId']),
            // 'bnidirect-api-key' => 'dc8f7943e027345677c7dade0441936c3bb3f8d697ef8f7b28ae5dfdeea78dd1',
            // 'bnidirect-api-key' => 'a39a04f8801b490da63db5b5e71b95ea6e0d8b6782df26b52c48c35bc19c22f2',
            'X-Signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'X-Timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }
}
 ?>