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
    /**
     * Page constructor.
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Get hello
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHello()
    {
        return __('%1', $this->getData('vasya2'));
    }
}
