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
use balanceInquiry;
use domesticSingleBIFastTransfer;
use inquiryForexRate;
use inquiryChildAccount;
use inquiryBIFastBeneficiaryName;
use callbackApi;
use bulkPaymentMixed;
use payrollMixed;

require_once('src/api/BniDirectService/createMPNG2Billing.php');
require_once('src/api/BniDirectService/inquiryNPWP.php');
require_once('src/api/BniDirectService/inquiryInhouseAndVABeneficiaryName.php');
require_once('src/api/BniDirectService/inquiryLLG_RTGS_OnlineBeneficiaryName.php');
require_once('src/api/BniDirectService/inquiryAccountStatement.php');
require_once('src/api/BniDirectService/inquiryBilling.php');
require_once('src/api/BniDirectService/inquiryBniPopsCashAndCarry.php');
require_once('src/api/BniDirectService/balanceInquiry.php');
require_once('src/api/BniDirectService/domesticSingleBIFastTransfer.php');
require_once('src/api/BniDirectService/inquiryForexRate.php');
require_once('src/api/BniDirectService/inquiryChildAccount.php');
require_once('src/api/BniDirectService/inquiryBIFastBeneficiaryName.php');
require_once('src/api/BniDirectService/callbackApi.php');
require_once('src/api/BniDirectService/bulkPaymentMixed.php');
require_once('src/api/BniDirectService/payrollMixed.php');

class BNIDirect {
    use createMPNG2BillingService;
    use inquiryNPWPService;
    use inquiryInhouseAndVABeneficiaryNameService;
    use inquiryLLG_RTGS_OnlineBeneficiaryNameService;
    use inquiryAccountStatementService;
    use inquiryBillingService;
    use inquiryBniPopsCashAndCarryService;
    use balanceInquiry;
    use domesticSingleBIFastTransfer;
    use inquiryForexRate;
    use inquiryChildAccount;
    use inquiryBIFastBeneficiaryName;
    use callbackApi;
    use bulkPaymentMixed;
    use payrollMixed;
    
    protected $httpClient;
    protected $utils;
    protected $bni;

    function __construct(Bni $bni)
    {
        $this->bni = $bni;
        $this->httpClient = new HttpClient;
        $this->utils = new Util;
    }

    private function generateBniDirectKey(string $corporateId, string $userId, string $bniDirectApiKey){
        $data = strtolower($corporateId).strtolower($userId).$bniDirectApiKey;
        $encrypData = hash('sha256', $data);
        
        return strtolower($encrypData);
    }

    protected function requestBNIDirect($url, $dataJson, $data ) {
        $time = $this->utils->getTimeStamp();
        $header = [
            'X-API-Key' => $this->bni->apiKey,
            // 'bnidirect-api-key' => $this->generateBniDirectKey($data->corporateId, $data->userId, "dummyKey"), //sandbox
            'bnidirect-api-key' => 'dc8f7943e027345677c7dade0441936c3bb3f8d697ef8f7b28ae5dfdeea78dd1',
            'X-Signature' => $this->utils->generateSignatureV2($data, $this->bni->apiSecret, $time),
            'X-Timestamp' => $time
        ];
        return $this->httpClient->request('POST', $url, $header, $dataJson);
    }
}
 ?>