<?php

namespace Smile\Customer\Model;

use Smile\Customer\Model\CustomerVisitedUrls as ResourceModel;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;
use Magento\Framework\Model\AbstractModel;

class CustomerVisitedUrls extends AbstractModel implements CustomerVisitedUrlsInterface
{
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

    public function getCustomerId(): int
    {
        return $this->getData(CustomerVisitedUrlsInterface::CUSTOMER_ID);
    }

    public function getVisitedUrl(): string
    {
        return $this->getData(CustomerVisitedUrlsInterface::VISITED_URL);
    }

    public function getCreatedAt(): string
    {
        return $this->getData(CustomerVisitedUrlsInterface::CREATED_AT);
    }

    public function isActive(): bool
    {
        return (bool) $this->getData(CustomerVisitedUrlsInterface::IS_ACTIVE);
    }

    public function setCustomerId(int $customerId): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::CUSTOMER_ID, $customerId);
    }

    public function setVisitedUrl(string $url): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::VISITED_URL, $url);
    }

    public function setCreatedAt(string $createdAt): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::CREATED_AT, $createdAt);
    }

    public function setIsActive(bool $isActive): CustomerVisitedUrlsInterface
    {
        return $this->setData(CustomerVisitedUrlsInterface::IS_ACTIVE, $isActive);
    }
}
