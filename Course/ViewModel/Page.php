<?php

namespace Smile\Course\ViewModel;

/**
 * Class Page
 *
 * @package Smile\Course\ViewModel
 */
class Page implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getSomeText()
    {
        return __('Text from class :D');
    }
}
