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
     * @var string
     */
    protected $testDI;

    /**
     * CustomerUrls constructor.
     *
     * @param \Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface $repository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param string $testDI
     */
    public function __construct(
        \Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface $repository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        $testDI = 'No DI inserted'
    ) {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->testDI = $testDI;
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

    public function getTestDI()
    {
        return $this->testDI;
    }
}
