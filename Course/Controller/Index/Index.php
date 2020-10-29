<?php
/**
 * Observer IndexActionAfterExecution
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

namespace Smile\Course\Controller\Index;

use Magento\Cms\Api\GetBlockByIdentifierInterface;
use Magento\Framework\Api\SearchCriteriaInterface as SearchCriteriaInterfaceAlias;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterfaceFactory;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;

/**
 * Class Index
 *
 * @package Smile\Course\Controller\Index
 */
class Index extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    const BLOCK_IDENTIFIER = 'women-block';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var GetBlockByIdentifierInterface
     */
    protected $getBlockByIdentifier;

    /**
     * @var SearchCriteriaInterfaceAlias
     */
    protected $searchCriteria;

    /**
     * @var CustomerVisitedUrlsInterfaceFactory
     */
    protected $visitedUrlsInterfaceFactory;

    /**
     * @var CustomerVisitedUrlsRepositoryInterface
     */
    protected $customerVisitedUrlsRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param GetBlockByIdentifierInterface $getBlockByIdentifier
     * @param SearchCriteriaInterfaceAlias $searchCriteria
     * @param CustomerVisitedUrlsInterfaceFactory $visitedUrlsInterfaceFactory
     * @param CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        GetBlockByIdentifierInterface $getBlockByIdentifier,
        SearchCriteriaInterfaceAlias $searchCriteria,
        CustomerVisitedUrlsInterfaceFactory $visitedUrlsInterfaceFactory,
        CustomerVisitedUrlsInterface $visitedUrlsInterface,
        CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->getBlockByIdentifier = $getBlockByIdentifier;
        $this->searchCriteria = $searchCriteria;
        $this->visitedUrlsInterfaceFactory = $visitedUrlsInterfaceFactory;
        $this->customerVisitedUrlsRepository = $customerVisitedUrlsRepository;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->resultPageFactory->create();

        $model = $this->visitedUrlsInterfaceFactory->create();
        $model->setCustomerId(null)
            ->setVisitedUrl($this->getRequest()->getUri())
            ->setIsActive(1);

        $this->customerVisitedUrlsRepository->save($model);

        return $page;
    }
}
