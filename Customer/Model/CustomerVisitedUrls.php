<?php

namespace Smile\Customer\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;
use Smile\Customer\Model\ResourceModel\CustomerVisitedUrls as ResourceModel;

class CustomerVisitedUrls extends AbstractModel implements CustomerVisitedUrlsInterface
{
    /**
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param CustomerVisitedUrlsValidator $customerVisitedUrlsValidator
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        CustomerVisitedUrlsValidator $customerVisitedUrlsValidator,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->_validatorBeforeSave = $customerVisitedUrlsValidator;
    }

    /**
     * Init resource model and id field
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(ResourceModel::class);
        $this->setIdFieldName(CustomerVisitedUrlsInterface::ID);
    }

    /**
     * Get customer id
     *
     * @return int|string|null
     */
    public function getCustomerId()
    {
        return $this->getData(CustomerVisitedUrlsInterface::CUSTOMER_ID);
    }

    /**
     * Get visited url
     *
     * @return string
     */
    public function getVisitedUrl(): string
    {
        return $this->getData(CustomerVisitedUrlsInterface::VISITED_URL);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(CustomerVisitedUrlsInterface::CREATED_AT);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->getData(CustomerVisitedUrlsInterface::IS_ACTIVE);
    }

    /**
     * Set customer id
     *
     * @param int|null $customerId
     *
     * @return CustomerVisitedUrlsInterface
     */
    public function setCustomerId(?int $customerId): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::CUSTOMER_ID, $customerId);
    }

    /**
     * Set visited url
     *
     * @param string $url
     *
     * @return CustomerVisitedUrlsInterface
     */
    public function setVisitedUrl(string $url): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::VISITED_URL, $url);
    }

    /**
     * Set created at
     *
     * @param string $createdAt
     *
     * @return CustomerVisitedUrlsInterface
     */
    public function setCreatedAt(string $createdAt): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::CREATED_AT, $createdAt);
    }

    /**
     * Set is active
     *
     * @param bool $isActive
     *
     * @return CustomerVisitedUrlsInterface
     */
    public function setIsActive(bool $isActive): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::IS_ACTIVE, $isActive);
    }

    public function getPageTitle()
    {
        return $this->getData(CustomerVisitedUrlsInterface::PAGE_TITLE);
    }

    public function setPageTitle(string $pageTitle): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::PAGE_TITLE, $pageTitle);
    }
}
