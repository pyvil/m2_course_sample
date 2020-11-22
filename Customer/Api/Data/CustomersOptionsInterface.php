<?php

namespace Smile\Customer\Api\Data;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Interface CustomersOptions
 *
 * @package Smile\Customer\Api\Data
 */
interface CustomersOptionsInterface extends OptionSourceInterface
{
    /**#@+
     * Default values
     */
    const EMPTY_VALUE = 0;
    /**#@-*/

    /**#@+
     * Empty text
     */
    const EMPTY_TEXT = 'Choose value';
    /**#@-*/
}
