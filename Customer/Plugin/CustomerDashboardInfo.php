<?php
namespace Smile\Customer\Plugin;

class CustomerDashboardInfo
{
    public function afterGetName($object, $result)
    {
        return $result;
    }

    public function aroundGetName($object, $realFunction)
    {
        $result = $realFunction();
        return __('%1 => (%2)', $result, $object->getCustomer()->getCreatedAt());
    }
}
