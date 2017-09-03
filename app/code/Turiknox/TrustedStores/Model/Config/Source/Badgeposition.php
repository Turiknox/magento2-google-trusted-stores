<?php
/*
 * Turiknox_TrustedStores

 * @category   Turiknox
 * @package    Turiknox_TrustedStores
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-google-trusted-stores/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\TrustedStores\Model\Config\Source;

class Badgeposition
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'BOTTOM_LEFT', 'label' => __('Bottom Left')],
            ['value' => 'BOTTOM_RIGHT', 'label' => __('Bottom Right')]
        ];
    }
}
