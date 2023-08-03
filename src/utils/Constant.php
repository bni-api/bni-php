<?php

namespace BniApi\BniPhp\utils;

class Constant
{
    const ERROR_GET_TOKEN = 'Error Get Token';

    const URL_GET_TOKEN = '/api/oauth/token';

    const URL_H2H_GETBALANCE = '/H2H/v2/getbalance';
    const URL_H2H_GETINHOUSEINQUIRY = '/H2H/v2/getinhouseinquiry';
    const URL_H2H_DOYPAYMENT = '/H2H/v2/dopayment';
    const URL_H2H_GETPAYMENTSTATUS = '/H2H/v2/getpaymentstatus';
    const URL_H2H_GETINTERBANKINQUIRY = '/H2H/v2/getinterbankinquiry';
    const URL_H2H_GETINTERBANKPAYMENT = '/H2H/v2/getinterbankpayment';
    const URL_H2H_HOLDAMOUNT = '/H2H/v2/holdamount';
    const URL_H2H_HOLDAMOUNTRELEASE = '/H2H/v2/holdamountrelease';


    const URL_SNAP_GETTOKEN = '/snap/v1/access-token/b2b';
    const URL_SNAP_BALANCEINQUIRY = '/snap-service/v1/balance-inquiry';
    const URL_SNAP_BANKSTATEMENT = '/snap-service/v1/bank-statement';
    const URL_SNAP_INTERNALACCOUNTINQUIRY = '/snap-service/v1/account-inquiry-internal';
    const URL_SNAP_TRANSACTIONSTATUSINQUIRY = '/snap-service/v1/transfer/status';
    const URL_SNAP_TRANSFERINTRABANK = '/snap-service/v1/transfer-intrabank';
    const URL_SNAP_TRANSFERRTGS = '/snap-service/v1/transfer-rtgs';
    const URL_SNAP_TRANSFERSKNBI = '/snap-service/v1/transfer-skn';
    const URL_SNAP_EXTERNALACCOUNTINQUIRY = '/snap-service/v1/account-inquiry-external';
    const URL_SNAP_TRANSFERINTERBANK = '/snap-service/v1/transfer-interbank';

    const URL_RDN_FACERECOGNITION = '/rekdana/v1.1/face/recog';
    const URL_RDN_CHECKSIDV2 = '/rdn/v2.1/checksid';
    const URL_RDN_REGISTERINVESTOR = '/rdn/v2.1/register/investor';
    const URL_RDN_REGISTERINVESTORACCOUNT = '/rdn/v2.1/register/investor/account';
    const URL_RDN_SENDATASTATIC = '/rdn/v2.1/senddatastatic';
    const URL_RDN_INQUIRYACCOUNTBALANCE = '/rdn/v2.1/inquiry/account/balance';
    const URL_RDN_INQUIRYACCOUNTHISTORY = '/rdn/v2.1/inquiry/account/history';
    const URL_RDN_INQUIRYACCOUNTINFO = '/rdn/v2.1/inquiry/account/info';
    const URL_RDN_PAYMENTUSINGTRANSFER = '/rdn/v2.1/payment/transfer';
    const URL_RDN_PAYMENTUSINGCLEARING = '/rdn/v2.1/payment/clearing';
    const URL_RDN_INQUIRYINTERBANKACCOUNT = '/rdn/v2.1/inquiry/interbank/account';
    const URL_RDN_PAYMENTUSINGRTGS = '/rdn/v2.1/payment/rtgs';
    const URL_RDN_INQUIRYPAYMENTSTATUS = '/rdn/v2.1/inquiry/payment/status';
    const URL_RDN_PAYMENTUSINGINTERBANK = '/rdn/v2.1/payment/interbank';


    const URL_RDL_FACERECOGNITION = '/rekdana/v1.1/face/recog';
    const URL_RDL_REGISTERINVESTOR = '/rdl/v2.1/register/investor';
    const URL_RDL_REGISTERINVESTORACCOUNT = '/rdl/v2.1/register/investor/account';
    const URL_RDL_INQUIRYACCOUNTBALANCE = '/rdl/v2.1/inquiry/account/balance';
    const URL_RDL_INQUIRYACCOUNTHISTORY = '/rdl/v2.1/inquiry/account/history';
    const URL_RDL_INQUIRYACCOUNTINFO = '/rdl/v2.1/inquiry/account/info';
    const URL_RDL_PAYMENTUSINGTRANSFER = '/rdl/v2.1/payment/transfer';
    const URL_RDL_PAYMENTUSINGCLEARING = '/rdl/v2.1/payment/clearing';
    const URL_RDL_INQUIRYINTERBANKACCOUNT = '/rdl/v2.1/inquiry/interbank/account';
    const URL_RDL_PAYMENTUSINGRTGS = '/rdl/v2.1/payment/rtgs';
    const URL_RDL_INQUIRYPAYMENTSTATUS = '/rdl/v2.1/inquiry/payment/status';
    const URL_RDL_PAYMENTUSINGINTERBANK = '/rdl/v2.1/payment/interbank';


    const URL_RDF_FACERECOGNITION = '/rekdana/v1.1/face/recog';
    const URL_RDF_REGISTERINVESTOR = '/rdf/v2.1/register/investor';
    const URL_RDF_REGISTERINVESTORACCOUNT = '/rdf/v2.1/register/investor/account';
    const URL_RDF_INQUIRYACCOUNTBALANCE = '/rdf/v2.1/inquiry/account/balance';
    const URL_RDF_INQUIRYACCOUNTHISTORY = '/rdf/v2.1/inquiry/account/history';
    const URL_RDF_INQUIRYACCOUNTINFO = '/rdf/v2.1/inquiry/account/info';
    const URL_RDF_PAYMENTUSINGTRANSFER = '/rdf/v2.1/payment/transfer';
    const URL_RDF_PAYMENTUSINGCLEARING = '/rdf/v2.1/payment/clearing';
    const URL_RDF_PAYMENTUSINGRTGS = '/rdf/v2.1/payment/rtgs';
    const URL_RDF_INQUIRYINTERBANKACCOUNT = '/rdf/v2.1/inquiry/interbank/account';
    const URL_RDF_INQUIRYPAYMENTSTATUS = '/rdf/v2.1/inquiry/payment/status';
    const URL_RDF_PAYMENTUSINGINTERBANK = '/rdf/v2.1/payment/interbank';
}
