<?php
namespace Smile\Test\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Smile\Course\ViewModel\Page;

/**
 * Customer helper for view.
 */
class Data extends AbstractHelper
{
    /**
     * @var Page
     */
    protected $smilePage;

    /**
     * @param Context $context
     * @param Page $smilePage
     */
    public function __construct(Context $context, Page $smilePage)
    {
        parent::__construct($context);
        $this->smilePage = $smilePage;
    }

    public function getText()
    {
        return __('text');
    }

    public function getOtherText()
    {
        return $this->smilePage->getSomeText();
    }
}
