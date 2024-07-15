<?php

use BniApi\BniPhp\utils\Constant;
use BniApi\BniPhp\utils\Response;
use GuzzleHttp\RequestOptions;

trait billingPayment
{
    public function billingPayment(
        string $corporateId,
        string $userId,
        string $debitedAccountNo,
        string $institution,
        string $payeeName,
        string $customerInformation1,
        string $customerInformation2,
        string $customerInformation3,
        string $customerInformation4,
        string $customerInformation5,
        string $billPresentmentFlag,
        string $remitterRefNo,
        string $finalizePaymentFlag,
        string $beneficiaryRefNo,
        string $notificationFlag,
        string $beneficiaryEmail,
        string $transactionInstructionDate,
        string $amountCurrency,
        string $amount,
    ){
        $url = $this->bni->getBaseUrl() . Constant::URL_BNI_DIRECT_BILLING_PAYMENT . '?access_token=' . $this->bni->getToken();
        $data = [
            'corporateId' => $corporateId,
            'userId' => $userId,
            'debitedAccountNo' => $debitedAccountNo,
            'institution' => $institution,
            'payeeName' => $payeeName,
            'customerInformation1' => $customerInformation1,
            'customerInformation2' => $customerInformation2,
            'customerInformation3' => $customerInformation3,
            'customerInformation4' => $customerInformation4,
            'customerInformation5' => $customerInformation5,
            'billPresentmentFlag' => $billPresentmentFlag,
            'remitterRefNo' => $remitterRefNo,
            'finalizePaymentFlag' => $finalizePaymentFlag,
            'beneficiaryRefNo' => $beneficiaryRefNo,
            'notificationFlag' => $notificationFlag,
            'beneficiaryEmail' => $beneficiaryEmail,
            'transactionInstructionDate' => $transactionInstructionDate,
            'amountCurrency' => $amountCurrency,
            'amount' => $amount,
        ];
        $dataJson = [
            RequestOptions::JSON => $data
        ];
        $response = $this->requestBNIDirect($url, $dataJson, $data );

        return Response::BniDirect($response);
    }
}

?>