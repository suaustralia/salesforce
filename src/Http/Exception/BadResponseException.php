<?php


namespace GenesisGlobal\Salesforce\Http\Exception;

/**
 * Class BadResponseException
 * @package GenesisGlobal\Salesforce\Http\Exception
 */
class BadResponseException extends \Exception
{
    /**
     * BadResponseException constructor.
     * @param string $message
     * @param int $code
     * @param null $previous
     * @param mixed|null $response
     */
    public function __construct(string $message = "", int $code = 0, $previous = null, protected mixed $response = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
