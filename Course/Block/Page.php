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

/**
 * Class Page
 *
 * @package Smile\Course\Block
 */
class Page extends Template
{
    protected $_test1 = '';

    /**
     * Page constructor.
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_test1 = $this->_data['testArrayData']['test1'];
    }

    /**
     * Get hello
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHello()
    {
        return __('%1 %2', $this->_data['testArrayData']['test1'], $this->_data['testArrayData']['test2']);
    }

    public function getText1()
    {
        return $this->_test1;
    }
}
