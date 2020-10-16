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

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\GetBlockByIdentifierInterface;
use Magento\Cms\Model\BlockRepository;
use Magento\Framework\Api\SearchCriteriaInterface as SearchCriteriaInterfaceAlias;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

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
     * @var BlockRepositoryInterface
     */
    private $blockRepository;
    /**
     * @var SearchCriteriaInterfaceAlias
     */
    private $searchCriteria;
    /**
     * @var Context
     */
    private $context;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param GetBlockByIdentifierInterface $getBlockByIdentifier
     * @param BlockRepositoryInterface $blockRepository
     * @param SearchCriteriaInterfaceAlias $searchCriteria
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        GetBlockByIdentifierInterface $getBlockByIdentifier,
        BlockRepositoryInterface $blockRepository,
        SearchCriteriaInterfaceAlias $searchCriteria
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->getBlockByIdentifier = $getBlockByIdentifier;
        $this->blockRepository = $blockRepository;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->resultPageFactory->create();
        $block = $this->getBlockByIdentifier->execute(self::BLOCK_IDENTIFIER, 0);
        $collection = $this->blockRepository->getList($this->searchCriteria);
        return $page;
    }
}
