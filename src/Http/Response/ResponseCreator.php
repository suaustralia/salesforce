<?php

/**
 * Created by PhpStorm.
 * User: qbik
 * Date: 27.06.2017
 * Time: 14:22
 */

namespace GenesisGlobal\Salesforce\Http\Response;

/**
 * Class ResponseCreator
 * @package GenesisGlobal\Salesforce\Http\Response
 */
class ResponseCreator implements ResponseCreatorInterface
{
    /** error codes constants */
    const ERROR_CODE_BAD_RESPONSE = 'SALESFORCE_RESPONSE_MALFORMED';
    const ERROR_MESSAGE_BAD_RESPONSE = 'Response from salesforce malformed.';

    /**
     * @param $httpResponse
     * @return Response
     */
    public function create($httpResponse)
    {
        if ($httpResponse instanceof \Httpful\Response) {
            $response = new Response();
            $response->setSuccess($this->resolveSuccess($httpResponse));
            $response->setContent($httpResponse->body);
            $response->setCode($httpResponse->code);

            // if errors exist, lets add it!
            if (isset($httpResponse->body->errors) && !empty($httpResponse->body->errors)) {
                foreach ($httpResponse->body->errors as $errorFromSalesforce) {
                    $errorCode = (is_object($errorFromSalesforce) and $errorFromSalesforce->errorCode ?? null);
                    $errorMessage = (is_object($errorFromSalesforce) and $errorFromSalesforce->message ?? $errorFromSalesforce);

                    $error = new ResponseError();
                    $error->setCode($errorCode);
                    $error->setMessage($errorMessage);
                    $response->addError($error);
                }
            }
        } else {
            // it should not happen really
            $response = $this->getFailedHttpResponse();
        }
        return $response;
    }

    /**
     * @return Response
     */
    protected function getFailedHttpResponse()
    {
        $response = new Response();
        $response->setSuccess(false);
        $error = new ResponseError();
        $error->setMessage(self::ERROR_MESSAGE_BAD_RESPONSE);
        $error->setCode(self::ERROR_CODE_BAD_RESPONSE);
        $response->addError($error);

        return $response;
    }

    /**
     * @param \Httpful\Response $response
     * @return bool
     */
    protected function resolveSuccess(\Httpful\Response $response)
    {
        if ($response->code >= 400) {
            return false;
        }
        return true;
    }
}