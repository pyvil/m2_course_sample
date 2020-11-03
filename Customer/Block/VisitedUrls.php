<?php
/**
 * Observer IndexActionAfterExecution
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

namespace Smile\Customer\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Page
 *
 * @package Smile\Course\Block
 */
class VisitedUrls extends Template
{
    /**
     * @var \Smile\Customer\ViewModel\CustomerUrls
     */
    protected $customerUrlsViewModel;

    /**
     * Page constructor.
     *
     * @param Template\Context $context
     * @param \Smile\Customer\ViewModel\CustomerUrls $customerUrlsViewModel
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Smile\Customer\ViewModel\CustomerUrls $customerUrlsViewModel,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerUrlsViewModel = $customerUrlsViewModel;
    }

    /**
     * @return mixed
     */
    public function getCustomerUrls()
    {
        return $this->customerUrlsViewModel->getNoLoginCustomerVisitedUrls();
    }
}
