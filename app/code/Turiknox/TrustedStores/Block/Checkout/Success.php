<?php
namespace Turiknox\TrustedStores\Block\Checkout;
/*
 * Turiknox_TrustedStores

 * @category   Turiknox
 * @package    Turiknox_TrustedStores
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-google-trusted-stores/blob/master/LICENSE.md
 * @version    1.0.0
 */
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Success extends Template
{
    /**
     * Date format of estimated shipping/delivery date
     *
     * @var string
     */
    protected $_dateFormat = 'Y-m-d';

    /**
     * @var Session
     */
    protected $_checkoutSession;

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $_order;

    /**
     * Success constructor.
     * @param Template\Context $context
     * @param Session $checkoutSession
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $checkoutSession,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->_checkoutSession = $checkoutSession;
        $this->_scopeConfig = $scopeConfig;
        $this->_order = $this->_checkoutSession->getLastRealOrder();
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
     * Get order
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * Get the order ID
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->_order->getIncrementId();

    }

    /**
     * Get customer email
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->_order->getCustomerEmail();
    }

    /**
     * Get the customer country code
     *
     * @return string
     */
    public function getCustomerCountry()
    {
        return $this->_order->getShippingAddress()->getCountryId();
    }

    /**
     * Get the order currency code.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->_order->getOrderCurrencyCode();
    }

    /**
     * Get the order total
     *
     * @return string
     */
    public function getGrandTotal()
    {
        return number_format($this->_order->getGrandTotal(), 2, '.' , '');
    }

    /**
     * Get the order discount
     *
     * @return string
     */
    public function getDiscounts()
    {
        return number_format($this->_order->getDiscountAmount(), 2, '.', '');
    }

    /**
     * Get the shipping amount.
     *
     * @return float
     */
    public function getShipping()
    {
        return number_format($this->_order->getShippingAmount(), 2, '.', '');
    }

    /**
     * Get tax amount against order.
     *
     * @return mixed
     */
    public function getTax()
    {
        return number_format($this->_order->getTaxAmount(), 2, '.', '');
    }

    /**
     * Calculates the estimated shipping date
     *
     * @return string
     */
    public function getEstimatedShippingDate()
    {
        $createdAt = $this->getCreatedAt();
        return $this->_addDays($createdAt, $this->_scopeConfig->getValue('google/trustedstores/estimated_shipping', ScopeInterface::SCOPE_STORE));
    }

    /**
     * Calculates the estimated delivery date
     *
     * @return string
     */
    public function getEstimatedDeliveryDate()
    {
        $createdAt = $this->getCreatedAt();
        return $this->_addDays($createdAt, $this->_scopeConfig->getValue('google/trustedstores/estimated_delivery', ScopeInterface::SCOPE_STORE));
    }

    /**
     * Get order created at timestamp
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_order->getCreatedAt();
    }

    /**
     * Add days to date
     *
     * @param $date
     * @param $daysToAdd
     *
     * @return bool|string
     */
    private function _addDays($date, $daysToAdd)
    {
        return date($this->_dateFormat, strtotime($date . ' + ' . $daysToAdd . ' days'));
    }

    /**
     * Check if the order contain virtual products
     *
     * @return bool
     */
    public function doesOrderContainDigitalProducts()
    {
        $containsDigitalProducts = false;
        foreach($this->getOrder()->getAllVisibleItems() as $item) {
            if ($item->getIsVirtual()) {
                $containsDigitalProducts = true;
            }
        }
        return $containsDigitalProducts;
    }

    /**
     * Check if the order contains back ordered products
     *
     * @return bool
     */
    public function doesOrderContainBackOrder()
    {
        $containsBackOrder = false;
        foreach($this->getOrder()->getAllVisibleItems() as $item) {
            if($item->getQtyBackordered()) {
                $containsBackOrder = true;
            }
        }
        return $containsBackOrder;
    }
}