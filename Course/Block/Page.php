<?php
/**
 * Observer IndexActionAfterExecution
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

namespace Smile\Course\Block;

use Magento\Framework\View\Element\Template;
use Smile\Customer\ViewModel\CustomerUrls;

/**
 * Class Page
 *
 * @package Smile\Course\Block
 */
class Page extends Template
{
    protected $_test1 = '';

    /**
     * @var CustomerUrls
     */
    protected $customerUrlsVM;

    /**
     * Page constructor.
     *
     * @param Template\Context $context
     * @param CustomerUrls $customerUrlsVM
     * @param array $data
     */
    public function __construct(Template\Context $context, CustomerUrls $customerUrlsVM, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_test1 = $this->_data['testArrayData']['test1'];
        $this->customerUrlsVM = $customerUrlsVM;
    }

    /**
     * Get hello
     *
     * @return string
     */
    public function getHello()
    {
        return $this->customerUrlsVM->getTestDI();
    }

    public function getText1()
    {
        return $this->_test1;
    }
}
