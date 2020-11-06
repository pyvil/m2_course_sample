<?php

namespace Smile\Customer\ViewModel;

use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;

/**
 * Class CustomerUrls
 *
 * @package Smile\Customer\ViewModel
 */
class CustomerUrls implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * CustomerUrls constructor.
     *
     * @param \Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface $repository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface $repository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return mixed
     */
    public function getNoLoginCustomerVisitedUrls()
    {
        $searchCriteria = $this->searchCriteriaBuilder
        ->addFilter(
            'main_table.' . CustomerVisitedUrlsInterface::IS_ACTIVE,
            CustomerVisitedUrlsInterface::ENABLED
        )->create();

        return $this->repository->getListWithCustomers($searchCriteria);
    }
}
