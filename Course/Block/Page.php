<?php
namespace Smile\Course\Block;

use Magento\Framework\View\Element\Template;

class Page extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getHello()
    {
        return __('%1', $this->getData('vasya2'));
    }
}
