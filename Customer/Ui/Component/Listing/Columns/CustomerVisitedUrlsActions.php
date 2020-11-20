<?php
namespace Smile\Customer\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class CustomerVisitedUrlsActions
 *
 * @package Smile\Customer\Ui\Component\Listing\Columns
 */
class CustomerVisitedUrlsActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getName()] = [
                    'edit' => [
                        'href' => $this->urlBuilder->getUrl(
                            $this->getData('config/viewUrl'),
                            [
                                $this->getData('config/idUrlParam') => $item['id']
                            ]
                        ),
                        'label' => __('View')
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl(
                            $this->getData('config/deleteUrl'),
                            [
                                $this->getData('config/idUrlParam') => $item['id']
                            ]
                        ),
                        'label' => __('Delete')
                    ],
                    'preview' => [
                        'href' => $this->urlBuilder->getUrl(
                            $this->getData('config/previewUrl'),
                            [
                                $this->getData('config/idUrlParam') => $item['id']
                            ]
                        ),
                        'label' => __('Preview')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
