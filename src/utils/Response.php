<?php

namespace BniApi\BniPhp\utils;

use Exception;
use UnexpectedValueException;

class Response
{
    public static function oneGatePayment($response, $resService)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->$resService->parameters->responseCode . ' : ' . $resObject->$resService->parameters->responseMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get a response from autopay API as an object
     *
     * @param $response GuzzleHttp\Psr7\Response
     * @return object
     */
    public static function autopay($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if (! str_starts_with($response->getStatusCode(), 200)) {
                throw new UnexpectedValueException(
                    $resObject->responseCode . ' : ' . $resObject->responseMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new UnexpectedValueException($e->getMessage());
        }
    }

    public static function snapBI($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->responseCode . ' : ' . $resObject->responseMessage
                );
            }

            $statusCodeSuccess = [
                '2001100',
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
                    $resObject->responseCode . ' : ' . $resObject->responseMessage
                );
            }
            
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function RDN($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->response->responseCode . ' : ' . $resObject->response->responseMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function RDL($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->response->responseCode . ' : ' . $resObject->response->responseMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function RDF($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->response->responseCode . ' : ' . $resObject->response->responseMessage . ' : ' . $resObject->response->errorMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function faceRecog($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    json_encode($resObject)
                );                    
                // if($resObject->response->responseCode){
                //     throw new Exception(
                //         $resObject->response->responseCode . ' : ' . $resObject->response->responseMessage
                //     );                    
                // }
                // throw new Exception(
                //     $resObject->Response->parameters->responseCode . ' : ' . $resObject->Response->parameters->responseMessage
                // );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function BniMove($response)
    {
        try {
            $resObject = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new Exception(
                    $resObject->response->responseCode . ' : ' . $resObject->response->responseMessage . ' : ' . $resObject->response->errorMessage
                );
            }
            return $resObject;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
