<?php
/**
 * Observer IndexActionAfterExecution
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */
namespace Smile\Course\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class IndexActionAfterExecution
 *
 * @package Smile\Course\Observer
 */
class IndexActionAfterExecution implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Execute
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $observer;
    }
}
