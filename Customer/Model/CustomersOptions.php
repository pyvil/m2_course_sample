<?php
namespace Smile\Customer\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Smile\Customer\Api\Data\CustomersOptionsInterface;

/**
 * Class CustomersOptions
 *
 * @package Smile\Customer\Model
 */
class CustomersOptions implements CustomersOptionsInterface
{
    /**
     * Customer repository
     *
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Search criteria
     *
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Customer options
     *
     * @var array
     */
    protected $customerOptions = null;

    /**
     * CustomersOptions constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $list = $this->customerRepository->getList($this->searchCriteriaBuilder->create());
        if (is_null($this->customerOptions)) {
            $this->customerOptions = [];
            foreach ($list->getItems() as $item) {
                $this->customerOptions[] = [
                    'label' => __('(%1) %2 %3', $item->getId(), $item->getFirstName(), $item->getLastName()),
                    'value' => (int) $item->getId(),
                ];
            }
        }

        return $this->customerOptions;
    }
}
