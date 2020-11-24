<?php
/**
 * Observer IndexActionAfterExecution
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

namespace Smile\Test\Controller\Index;

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
class Pager extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

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
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
