<?php

namespace Smile\Customer\Model\Config\Source;

/**
 * Class CustomerStuffMultiselect
 *
 * @package Smile\Customer\Model\Config\Source
 */
class CustomerStuffMultiselect implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [
            [
                'label' => __('EU'),
                'value' => [
                    [
                        'label' => 'XXS',
                        'value' => 'XXS',
                    ],[
                        'label' => 'XS',
                        'value' => 'XS',
                    ],[
                        'label' => 'S',
                        'value' => 'S',
                    ],[
                        'label' => 'L',
                        'value' => 'L',
                    ],[
                        'label' => 'XL',
                        'value' => 'XL',
                    ],[
                        'label' => 'XXL',
                        'value' => 'XXL',
                    ],
                ]
            ],
            [
                'label' => __('USA'),
                'value' => [
                    [
                        'label' => '4',
                        'value' => '4',
                    ],[
                        'label' => '6',
                        'value' => '6',
                    ],[
                        'label' => '8',
                        'value' => '8',
                    ],[
                        'label' => '10',
                        'value' => '10',
                    ]
                ]
            ]
        ];
    }
}
