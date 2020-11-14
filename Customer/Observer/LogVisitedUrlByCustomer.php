<?php

namespace Smile\Customer\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config;
use Smile\Customer\Api\CustomerVisitedUrlsRepositoryInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterface;
use Smile\Customer\Api\Data\CustomerVisitedUrlsInterfaceFactory;

/**
 * Class LogVisitedUrlByCustomer
 *
 * @package Smile\Customer\Observer
 */
class LogVisitedUrlByCustomer implements ObserverInterface
{
    /**#@+
     * Skip types
     */
    const SKIP_TYPE_STRICT = 'strict';
    const SKIP_TYPE_REGEX = 'regex';
    /**#@-*/

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
     * @var Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $_urlPatternsToSkip = [
        self::SKIP_TYPE_STRICT => [
            '/'
        ],
        self::SKIP_TYPE_REGEX => [
            '.txt',
            'admin',
            '.ico',
            '.jpg',
            '.jpeg',
            '.png',
            '.gif',
            'font',
        ]
    ];

    /**
     * LogVisitedUrlByCustomer constructor.
     *
     * @param CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository
     * @param CustomerVisitedUrlsInterfaceFactory $visitedUrlsFactory
     * @param Session $customerSession
     * @param Config $config
     */
    public function __construct(
        CustomerVisitedUrlsRepositoryInterface $customerVisitedUrlsRepository,
        CustomerVisitedUrlsInterfaceFactory $visitedUrlsFactory,
        Session $customerSession,
        Config $config
    ) {
        $this->customerVisitedUrlsRepository = $customerVisitedUrlsRepository;
        $this->visitedUrlsFactory = $visitedUrlsFactory;
        $this->customerSession = $customerSession;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var Http $request */
        $request = $observer->getRequest();
        if ($this->urlAllowToSave($request->getRequestUri())) {
            $model = $this->visitedUrlsFactory->create();
            $model->setCustomerId($this->customerSession->getCustomerId())
                ->setVisitedUrl($request->getRequestUri())
                ->setIsActive(CustomerVisitedUrlsInterface::ENABLED)
                ->setPageTitle($this->config->getTitle()->get());
            $this->customerVisitedUrlsRepository->save($model);
        }
    }

    /**
     * Url is allowed to save
     *
     * @param $requestUri
     *
     * @return bool
     */
    protected function urlAllowToSave($requestUri)
    {
        $result = true;
        $requestUri = current(explode('?', $requestUri));
        foreach ($this->_urlPatternsToSkip as $type => $patterns) {
            foreach ($patterns as $pattern) {
                $result = !call_user_func_array([$this, 'check' . ucfirst($type)], [$requestUri, $pattern]);
                if (!$result) {
                    break 2;
                }
            }
        }

        return $result;
    }

    /**
     * Check Strict
     *
     * @param $requestUri
     * @param $pattern
     *
     * @return bool
     */
    protected function checkStrict($requestUri, $pattern)
    {
        return $requestUri === $pattern;
    }

    /**
     * Check Regex
     *
     * @param $requestUri
     * @param $pattern
     *
     * @return bool
     */
    protected function checkRegex($requestUri, $pattern)
    {
        return strpos($requestUri, $pattern) !== false;
    }
}
