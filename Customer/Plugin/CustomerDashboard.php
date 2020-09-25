<?php
namespace Smile\Customer\Plugin;

class CustomerDashboard
{
    public function afterGetSubscriptionText($subject, $result)
    {
        if (!$subject->getSubscriptionObject()->isSubscribed()) {
            return __('You are potatoes, as you are not subscribe !');
        }

        return $result;
    }
}
