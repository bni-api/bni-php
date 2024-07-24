<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait billingPayment
{
    /**
     * Bill Payment
     * @param string $corporateId Corporate ID (max 40 chars)
     * @param string $userId User ID (max 40 chars)
     * @param string $debitedAccountNo Debited Account (max 16 chars)
     * @param string $institution Institution (max 40 chars)
     * @param string $payeeName Payee Name (max 40 chars)
     * @param string $customerInformation1 Customer Information (1)
     * @param string $customerInformation2 Customer Information (2)
     * @param string $customerInformation3 Customer Information (3)
     * @param string $customerInformation4 Customer Information (4)
     * @param string $customerInformation5 Customer Information (5)
     * @param string $billPresentmentFlag Bill Presentment Flag (max 1 char)
     * @param string $remitterRefNo Remitter Reference No. (max 16 chars)
     * @param string $finalizePaymentFlag Finalize Payment Flag (max 1 char)
     * @param string $beneficiaryRefNo Beneficiary Reference No. (max 16 chars) (optional)
     * @param string $notificationFlag Notification Flag (max 1 char)
     * @param string $beneficiaryEmail Beneficiary Email (max 100 chars) (optional)
     * @param string $transactionInstructionDate Transaction Instruction Date (max 8 chars)
     * @param string $amountCurrency Amount Currency (max 3 chars)
     * @param string $amount Amount (max 18 chars)
     * @return Object
     */

    public function billingPayment(
        array $params
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BILLING_PAYMENT;
        $data = [
            'corporateId' => $params['corporateId'],
            'userId' => $params['userId'],
            'debitedAccountNo' => $params['debitedAccountNo'],
            'institution' => $params['institution'],
            'payeeName' => $params['payeeName'],
            'customerInformation1' => $params['customerInformation1'],
            'customerInformation2' => $params['customerInformation2'],
            'customerInformation3' => $params['customerInformation3'],
            'customerInformation4' => $params['customerInformation4'],
            'customerInformation5' => $params['customerInformation5'],
            'billPresentmentFlag' => $params['billPresentmentFlag'],
            'remitterRefNo' => $params['remitterRefNo'],
            'finalizePaymentFlag' => $params['finalizePaymentFlag'],
            'beneficiaryRefNo' => $params['beneficiaryRefNo'] ?? null,
            'notificationFlag' => $params['notificationFlag'],
            'beneficiaryEmail' => $params['beneficiaryEmail'] ?? null,
            'transactionInstructionDate' => $params['transactionInstructionDate'],
            'amountCurrency' => $params['amountCurrency'],
            'amount' => $params['amount'],
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>