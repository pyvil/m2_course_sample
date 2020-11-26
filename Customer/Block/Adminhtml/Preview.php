<?php
namespace Smile\Customer\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;

/**
 * Class Preview
 *
 * @package Smile\Customer\Block\Adminhtml
 */
class Preview extends Template
{
    /**
     * @var CustomerVisitedUrlsRepositoryInterface
     */
    protected $repository;

    protected $_model = null;

    /**
     * @param Context $context
     * @param CustomerVisitedUrlsRepositoryInterface $repository
     * @param array $data
     */
    public function __construct(
        Context $context,
        CustomerVisitedUrlsRepositoryInterface $repository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->repository = $repository;
    }

    /**
     * @return CustomerVisitedUrlsInterface
     */
    public function getModel()
    {
        if (is_null($this->_model)) {
            $this->_model = $this->repository->getByIdWithCustomerData($this->getRequest()->getParam(CustomerVisitedUrlsInterface::ID));
        }

        return $this->_model;
    }
}
