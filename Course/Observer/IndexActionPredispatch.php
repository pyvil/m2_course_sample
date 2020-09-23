<?php

namespace Smile\Course\Observer;

use Magento\Framework\Event\Observer;

class IndexActionPredispatch implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\App\RequestInterface $request */
        $request = $observer->getData('request');

        if ($request->getParam('page_type')) {
            $request->setParam('message', __('Observed!!!!'));
        }
    }
}
