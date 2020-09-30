<?php
/**
 * Plugin CustomerDashboard
 *
 * @category  Smile
 * @package   Smile\Customer
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

namespace Smile\Customer\Plugin;

/**
 * Class CustomerDashboard
 *
 * @package Smile\Customer\Plugin
 */
class CustomerDashboard
{
    /**
     * After get subscription text
     *
     * @param $subject
     * @param $result
     *
     * @return \Magento\Framework\Phrase
     */
    public function afterGetSubscriptionText($subject, $result)
    {
        if (!$subject->getSubscriptionObject()->isSubscribed()) {
            return __('You are potatoes, as you are not subscribe !');
        }

        return $result;
    }
}
