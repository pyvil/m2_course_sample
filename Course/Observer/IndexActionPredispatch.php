<?php
/**
 * Observer IndexActionPredispatch
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */
namespace Smile\Course\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class IndexActionPredispatch
 *
 * @package Smile\Course\Observer
 */
class IndexActionPredispatch implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Execute
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\App\RequestInterface $request */
        $request = $observer->getData('request');

        if ($request->getParam('page_type')) {
            $request->setParam('message', __('Observed!!!!'));
        }
    }
}
