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
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

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

        $data = '';
        if ($this->scopeConfig->getValue('god_mode/details/is_after_customer_name_visible')) {
            $data = $this->scopeConfig->getValue('god_mode/details/after_customer_name');
        }

        return __("%1 => (%2) \n %3", $result, $data, $this->scopeConfig->getValue('god_mode/details/allowed_sizes'));
    }
}
