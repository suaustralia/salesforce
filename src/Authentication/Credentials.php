<?php

namespace GenesisGlobal\Salesforce\Authentication;

/**
 * Class Credentials
 * @package GenesisGlobal\Salesforce\Authentication
 */
class Credentials implements CredentialsKeeperInterface
{
    /**
     * UsernamePasswordCredentials constructor.
     * @param $credentials
     */
    public function __construct(
        protected $credentials
    )
    {
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }
}
