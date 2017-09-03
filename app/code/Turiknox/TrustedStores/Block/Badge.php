<?php
/*
 * Turiknox_TrustedStores

 * @category   Turiknox
 * @package    Turiknox_TrustedStores
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-google-trusted-stores/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\TrustedStores\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Locale\Resolver;

class Badge extends Template
{
    const XML_PATH_TRUSTEDSTORES_ENABLE   = 'google/trustedstores/enable';
    const XML_PATH_TRUSTEDSTORES_ID       = 'google/trustedstores/id';
    const XML_PATH_TRUSTEDSTORES_POSITION = 'google/trustedstores/position';

    /**
     * @var Resolver
     */
    protected $localeResolver;

    /**
     * Badge constructor.
     * @param Template\Context $context
     * @param Resolver $localeResolver
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Resolver $localeResolver,
        array $data = []
    ) {
        $this->localeResolver = $localeResolver;
        parent::__construct($context, $data);
    }

    /**
     * Check if the module has been enabled in the admin
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_scopeConfig->getValue(self::XML_PATH_TRUSTEDSTORES_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get Trusted Stores ID
     *
     * @return int
     */
    public function getTrustedStoresId()
    {
        return $this->_scopeConfig->getValue(self::XML_PATH_TRUSTEDSTORES_ID, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get the badge position
     *
     * @return string
     */
    public function getBadgePosition()
    {
        return $this->_scopeConfig->getValue(self::XML_PATH_TRUSTEDSTORES_POSITION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get current locale
     *
     * @return null|string
     */
    public function getLocaleCode()
    {
        return $this->localeResolver->getLocale();
    }
}
