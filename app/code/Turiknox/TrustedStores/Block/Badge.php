<?php
namespace Turiknox\TrustedStores\Block;
/*
 * Turiknox_TrustedStores

 * @category   Turiknox
 * @package    Turiknox_TrustedStores
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-google-trusted-stores/blob/master/LICENSE.md
 * @version    1.0.0
 */
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Locale\Resolver;

class Badge extends Template
{

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var Resolver
     */
    protected $_localeResolver;

    /**
     * Badge constructor.
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Resolver $localeResolver
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        Resolver $localeResolver,
        array $data = []
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_localeResolver = $localeResolver;
        parent::__construct($context, $data);
    }

    /**
     * Check if the module has been enabled in the admin
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_scopeConfig->getValue('google/trustedstores/enable', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get Trusted Stores ID
     *
     * @return int
     */
    public function getTrustedStoresId()
    {
        return $this->_scopeConfig->getValue('google/trustedstores/id', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get the badge position
     *
     * @return string
     */
    public function getBadgePosition()
    {
        return $this->_scopeConfig->getValue('google/trustedstores/position', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get current locale
     *
     * @return null|string
     */
    public function getLocaleCode()
    {
        return $this->_localeResolver->getLocale();
    }
}