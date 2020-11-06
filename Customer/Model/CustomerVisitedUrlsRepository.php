<?php

namespace Smile\Customer\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterfaceFactory;
use Smile\Customer\Model\ResourceModel\CustomerVisitedUrls as ResourceCustomerVisitedUrls;
use Smile\Customer\Model\ResourceModel\CustomerVisitedUrls\CollectionFactory;

/**
 * Class CustomerVisitedUrlsRepository
 *
 * @package Smile\Customer\Model
 */
class CustomerVisitedUrlsRepository implements CustomerVisitedUrlsRepositoryInterface
{
    /**
     * @var ResourceModel\CustomerVisitedUrls
     */
    protected $resourceModel;

    /**
     * @var CustomerVisitedUrls
     */
    protected $modelFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $processor;

    /**
     * @var SearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * CustomerVisitedUrlsRepository constructor.
     *
     * @param ResourceCustomerVisitedUrls $resourceModel
     * @param CustomerVisitedUrlsInterfaceFactory $modelFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $processor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceCustomerVisitedUrls $resourceModel,
        CustomerVisitedUrlsInterfaceFactory $modelFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $processor,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->processor = $processor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Get by ID
     *
     * @param int $id
     *
     * @return CustomerVisitedUrls
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        /** @var \Smile\Customer\Model\CustomerVisitedUrls $model */
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id, CustomerVisitedUrlsInterface::ID);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('No such entity %1 !', $id));
        }

        return $model;
    }

    /**
     * Get By Url
     *
     * @param string $url
     *
     * @return CustomerVisitedUrls
     * @throws NoSuchEntityException
     */
    public function getByUrl(string $url)
    {
        /** @var \Smile\Customer\Model\CustomerVisitedUrls $model */
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $url, CustomerVisitedUrlsInterface::VISITED_URL);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('No such entity with url - %1 !', $url));
        }

        return $model;
    }

    /**
     * Get list
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var ResourceModel\CustomerVisitedUrls\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->processor->process($criteria, $collection);

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function getListWithCustomers(SearchCriteriaInterface $criteria)
    {
        /** @var ResourceModel\CustomerVisitedUrls\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->processor->process($criteria, $collection);

        $collection->joinCustomer();

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete by Id
     *
     * @param int $id
     */
    public function deleteById(int $id)
    {
        /** @var \Smile\Customer\Model\CustomerVisitedUrls $model */
        try {
            $model = $this->getById($id);
            $this->delete($model);
        } catch (NoSuchEntityException $e) {
        }
    }

    /**
     * Delete
     *
     * @param CustomerVisitedUrlsInterface $model
     *
     * @return void
     */
    public function delete(CustomerVisitedUrlsInterface $model)
    {
        try {
            $this->resourceModel->delete($model);
        } catch (\Exception $e) {
        }
    }

    /**
     * Save
     *
     * @param CustomerVisitedUrlsInterface $model
     *
     * @return CustomerVisitedUrlsInterface|null
     */
    public function save(CustomerVisitedUrlsInterface $model)
    {
        try {
            $this->resourceModel->save($model);
        } catch (\Exception $e) {
            return null;
        }

        return $model;
    }
}
