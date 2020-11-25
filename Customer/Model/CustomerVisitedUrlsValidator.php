<?php
namespace Smile\Customer\Model;

use Magento\Customer\Model\Session;
use Magento\Framework\Validator\AbstractValidator;
use Magento\Framework\Validator\NotEmpty;
use Zend_Validate_Exception;

class CustomerVisitedUrlsValidator extends AbstractValidator
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * CustomerVisitedUrlsValidator constructor.
     *
     * @param Session $customerSession
     */
    public function __construct(
        Session $customerSession
    ) {
        $this->customerSession = $customerSession;
    }

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
        if (!\Zend_Validate::is($pageTitle, NotEmpty::class)) {
            $messages['invalid_page_title'] = __('Page title cannot be empty');
        }

        $customerId = (int) $value->getCustomerId();
        if ((!is_numeric($customerId) || ($customerId === 0)) && $this->customerSession->isLoggedIn()) {
            $messages['invalid_customer_id'] = $customerId === 0 ? __('Customer Id cannot be 0') : __('Customer Id should be numeric');
        }

        $visitedUrl = $value->getVisitedUrl();
        if (!\Zend_Validate::is($visitedUrl, NotEmpty::class)) {
            $messages['invalid_url'] = __('Url cannot be empty');
        }

        $isActive = $value->isActive();
        if (!is_bool($isActive)) {
            $messages['invalid_active'] = __('Is active should be Yes or No');
        }

        $this->_addMessages($messages);

        return empty($messages);
    }
}
