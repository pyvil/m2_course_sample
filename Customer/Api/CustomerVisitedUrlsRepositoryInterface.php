<?php
namespace Smile\Customer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CustomerVisitedUrlsRepositoryInterface
 *
 * @package Smile\Customer\Api
 */
interface CustomerVisitedUrlsRepositoryInterface
{
    public function getById(int $id);

    public function getByUrl(string $url);

    public function getList(SearchCriteriaInterface $criteria);

    public function deleteById(int $id);

    public function delete(Data\CustomerVisitedUrlsInterface $model);

    public function save(Data\CustomerVisitedUrlsInterface $model);
}
