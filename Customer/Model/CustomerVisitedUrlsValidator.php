<?php
namespace Smile\Customer\Model;

use Zend_Validate_Exception;

class CustomerVisitedUrlsValidator extends \Magento\Framework\Validator\AbstractValidator
{
    /**
     * Is valid
     *
     * @param CustomerVisitedUrls $value
     *
     * @return bool
     * @throws Zend_Validate_Exception
     */
    public function isValid($value)
    {
        $messages = [];
        $pageTitle = $value->getPageTitle();
        if (!\Zend_Validate::is($pageTitle, \Magento\Framework\Validator\NotEmpty::class)) {
            $messages['invalid_page_title'] = 'Page title cannot be empty';
        }

        $visitedUrl = $value->getVisitedUrl();
        if (!\Zend_Validate::is($visitedUrl, \Magento\Framework\Validator\NotEmpty::class)) {
            $messages['invalid_url'] = 'Url cannot be empty';
        }

        $isActive = $value->isActive();
        if (!is_bool($isActive)) {
            $messages['invalid_active'] = 'Is active should be Yes or No';
        }

        $this->_addMessages($messages);

        return empty($messages);
    }
}
