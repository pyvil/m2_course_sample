<?php


namespace Smile\Customer\Api\Data;

/**
 * Interface CustomerVisitedUrls
 *
 * @package Smile\Customer\Api\Data
 */
interface CustomerVisitedUrlsInterface
{
    /**#@+
     * Fields
     */
    const ID = 'id';
    const CUSTOMER_ID = 'customer_id';
    const VISITED_URL = 'visited_url';
    const CREATED_AT = 'created_at';
    const IS_ACTIVE = 'is_active';
    const PAGE_TITLE = 'page_title';
    /**#@-*/

    /**#@+
     * IS_ACTIVE states
     */
    const ENABLED = 1;
    const DISABLED = 0;
    /**#@-*/

    public function getCustomerId() : ?int;
    public function getVisitedUrl() : string;
    public function getCreatedAt() : string;
    public function getPageTitle() : string;
    public function isActive() : bool;

    public function setCustomerId(?int $customerId) : self;
    public function setVisitedUrl(string $url) : self;
    public function setCreatedAt(string $createdAt) : self;
    public function setPageTitle(string $pageTitle) : self;
    public function setIsActive(bool $isActive) : self;
}
