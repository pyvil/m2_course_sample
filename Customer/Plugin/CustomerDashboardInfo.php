<?php
/**
 * Plugin CustomerDashboardInfo
 *
 * @category  Smile
 * @package   Smile\Customer
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */
namespace Smile\Customer\Plugin;

/**
 * Class CustomerDashboardInfo
 *
 * @package Smile\Customer\Plugin
 */
class CustomerDashboardInfo
{
    /**
     * After get name
     *
     * @param $object
     * @param $result
     *
     * @return mixed
     */
    public function afterGetName($object, $result)
    {
        return $result;
    }

    /**
     * Around get name
     *
     * @param $object
     * @param $realFunction
     *
     * @return \Magento\Framework\Phrase
     */
    public function aroundGetName($object, $realFunction)
    {
        $result = $realFunction();
        return __('%1 => (%2)', $result, $object->getCustomer()->getCreatedAt());
    }
}
