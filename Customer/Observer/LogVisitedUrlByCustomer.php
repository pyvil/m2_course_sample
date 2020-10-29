<?php

namespace Smile\Customer\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterfaceFactory;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;

/**
 * Class LogVisitedUrlByCustomer
 *
 * @package Smile\Customer\Observer
 */
class LogVisitedUrlByCustomer implements ObserverInterface
{
    /**
     * @var CustomerVisitedUrlsRepositoryInterface
     */
    protected $customerVisitedUrlsRepository;

    /**
     * @var CustomerVisitedUrlsInterfaceFactory
     */
    protected $visitedUrlsFactory;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * LogVisitedUrlByCustomer constructor.
     *
     * @param CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository
     * @param CustomerVisitedUrlsInterfaceFactory $visitedUrlsFactory
     * @param Session $customerSession
     */
    public function __construct(
        CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository,
        CustomerVisitedUrlsInterfaceFactory $visitedUrlsFactory,
        Session $customerSession
    ) {
        $this->customerVisitedUrlsRepository = $customerVisitedUrlsRepository;
        $this->visitedUrlsFactory = $visitedUrlsFactory;
        $this->customerSession = $customerSession;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var Http $request */
        $request = $observer->getRequest();
        $model = $this->visitedUrlsFactory->create();
        $model->setCustomerId($this->customerSession->getCustomerId())
            ->setVisitedUrl($request->getRequestUri())
            ->setIsActive(CustomerVisitedUrlsInterface::ENABLED);
        $this->customerVisitedUrlsRepository->save($model);
    }
}
