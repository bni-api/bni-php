<?php

namespace Wawatprigala\BniPhp\utils;

use Exception;

class Response
{
    public static function oneGatePayment($response, $resService)
    {
        try {
            $resObject = $response->object();
            if ($response->failed()) {
                throw new Exception(
                    $resObject->$resService->parameters->responseCode . ' : ' . $resObject->$resService->parameters->responseMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

    public static function snapBI($response)
    {
        try {
            $resObject = $response->object();
            if ($response->failed()) {
                throw new Exception(
                    $resObject->responseCode. ' : ' . $resObject->responseMessage
                );
            }

            $statusCodeSuccess = [
                '2000000',
                '2001400',
                '2001500',
                '2001600',
                '2001700',
                '2001800',
                '2002200',
                '2002300',
                '2003600',
                '2007300'
            ];

            if (!in_array($resObject->responseCode, $statusCodeSuccess)) {
                throw new Exception(
                    $resObject->responseCode. ' : ' . $resObject->responseMessage
                );
            }

            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }
}
