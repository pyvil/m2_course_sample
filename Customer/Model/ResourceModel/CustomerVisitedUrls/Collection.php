<?php

namespace Smile\Customer\Model\ResourceModel\CustomerVisitedUrls;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smile\Customer\Model\CustomerVisitedUrls;
use Smile\Customer\Model\ResourceModel\CustomerVisitedUrls as ResourceCustomerVisitedUrls;

/**
 * Class Collection
 *
 * @package Smile\Customer\Model\ResourceModel\CustomerVisitedUrls
 */
class Collection extends AbstractCollection
{
    /**
     * @inheridoc
     */
    protected function _construct()
    {
        $this->_init(CustomerVisitedUrls::class, ResourceCustomerVisitedUrls::class);
    }
}
