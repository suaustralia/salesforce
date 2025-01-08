<?php
namespace GenesisGlobal\Salesforce\Authentication;


use GenesisGlobal\Salesforce\Http\UrlGeneratorInterface;

/**
 * Class SalesforceAuthenticatorUrlGenerator
 * @package GenesisGlobal\Salesforce\Authentication
 */
class SalesforceAuthenticatorUrlGenerator implements UrlGeneratorInterface
{
    /**
     * SalesforceAuthenticatorUrlGenerator constructor.
     * @param string $endpoint
     */
    public function __construct(protected string $endpoint)
    {
    }

    /**
     * @param null $action
     * @param null $parameters
     * @return string
     */
    public function getUrl($action = null, $parameters = null, $relativeToRoot = false)
    {
        return $this->getBasePath();

    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        // make sure we got only one slash there :)
        return rtrim($this->endpoint, "/") . '/services/oauth2/token';
    }
}
