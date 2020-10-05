<?php

namespace Smile\Sales\Block\Order;

class History extends \Magento\Sales\Block\Order\History
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Sales\Model\Order\Config $orderConfig,
        array $data = []
    ) {
        parent::__construct($context, $orderCollectionFactory, $customerSession, $orderConfig, $data);
        $this->pageConfig->getTitle()->set(__('Here you will have your fucking orders'));
    }
}
