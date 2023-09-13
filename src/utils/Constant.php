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

    const ECOLLECTION_TYPE_CREATEBILLING = "createbilling";
    const ECOLLECTION_TYPE_UPDATEBILLING = "updatebilling";
    const ECOLLECTION_TYPE_INQUIRYBILLING = "inquirybilling";
    const ECOLLECTION_TYPE_INACTIVEBILLING = "inactivebilling";
}