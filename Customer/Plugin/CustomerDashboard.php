<?php
namespace Smile\Customer\Plugin;

class CustomerDashboard
{
    public function afterGetName($object, $result)
    {
        return __('%1 %2', $result, get_class($object));
    }
}
