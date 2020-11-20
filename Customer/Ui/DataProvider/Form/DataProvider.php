<?php

namespace Smile\Customer\Ui\DataProvider\Form;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Smile\Customer\Model\ResourceModel\CustomerVisitedUrls\CollectionFactory as CustomerVisitedUrlsCollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData = [];

    /**
     * @var CustomerVisitedUrlsCollectionFactory
     */
    protected $customerVisitedUrlsCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CustomerVisitedUrlsCollectionFactory $customerVisitedUrlsCollectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $customerVisitedUrlsCollectionFactory->create();
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!empty($this->_loadedData)) {
            return $this->_loadedData;
        }

        $this->collection->addFieldToFilter($this->getPrimaryFieldName(), $this->request->getParam($this->getRequestFieldName()));

        foreach ($this->getCollection() as $item) {
            $this->_loadedData[$item->getId()] = $item->getData();
        }

        return $this->_loadedData;
    }
}
