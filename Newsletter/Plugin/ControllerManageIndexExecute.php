<?php
/**
 * Plugin ControllerManageIndexExecute
 *
 * @category  Smile
 * @package   Smile\Newsletter
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */
namespace Smile\Newsletter\Plugin;

/**
 * Class ControllerManageIndexExecute
 *
 * @package Smile\Newsletter\Plugin
 */
class ControllerManageIndexExecute
{
    /**
     * View
     *
     * @var \Magento\Framework\App\ViewInterface
     */
    private $view;

    /**
     * ControllerManageIndexExecute constructor.
     *
     * @param \Magento\Framework\App\ViewInterface $view
     */
    public function __construct(
        \Magento\Framework\App\ViewInterface $view
    ) {
        $this->view = $view;
    }

    /**
     * Around plugin implementation
     *
     * @param \Magento\Newsletter\Controller\Manage\Index $subject
     * @param \Closure $closure
     */
    public function aroundExecute($subject, $closure)
    {
        $this->view->loadLayout();
        $this->view->getPage()->getConfig()->getTitle()->set(__('Lol'));
        $this->view->renderLayout();
    }
}
