<?php

namespace Smile\Course\Setup\Patch\Data;

use Magento\Eav\Model\Config as EavConfig;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\File\Csv;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SampleData\FixtureManager;
use Magento\Store\Model\StoreManagerInterface;

class InstallCustomerAttributes implements DataPatchInterface
{
    /**
     * CSV reader
     *
     * @var Csv
     */
    protected $csvReader;

    /**
     * Fixture manager
     *
     * @var FixtureManager
     */
    protected $fixtureManager;

    /**
     * Eav setup
     *
     * @var EavSetup
     */
    protected $eavConfig;

    /**
     * Event manager interface
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * Attribute set factory
     *
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Eav Setup
     *
     * @var EavSetup
     */
    protected $eavSetup;

    /**
     * InstallCustomerAttributes constructor
     *
     * @param Csv                   $csvReader
     * @param FixtureManager        $fixtureManager
     * @param EavSetup              $eavSetup
     * @param EventManagerInterface $eventManager
     * @param EavConfig             $eavConfig
     * @param AttributeSetFactory   $attributeSetFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Csv $csvReader,
        FixtureManager $fixtureManager,
        EavSetup $eavSetup,
        EventManagerInterface $eventManager,
        EavConfig $eavConfig,
        AttributeSetFactory $attributeSetFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->csvReader = $csvReader;
        $this->fixtureManager = $fixtureManager;
        $this->eavSetup = $eavSetup;
        $this->eventManager = $eventManager;
        $this->eavConfig = $eavConfig;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->storeManager = $storeManager;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->addCustomerAttributes(
            'Smile_Course::Setup/Patch/Data/include/AddCustomerAttributes.csv',
            ' customer'
        );
    }

    /**
     * Add customer attributes
     *
     * @param string $fixture
     * @param string $type
     *
     * @return void
     */
    public function addCustomerAttributes($fixture, $type)
    {
        $rows = $this->csvReader->getData($this->fixtureManager->getFixture($fixture));
        $rowsHeader = array_shift($rows);

        $attributeSetId = $this->eavConfig->getEntityType($type)->getDefaultAttributeSetId();
        $attributeGroupId = $this->attributeSetFactory->create()->getDefaultGroupId($attributeSetId);

        foreach ($rows as $row) {
            $row = array_combine($rowsHeader, $row);
            $isAttribute = $this->eavSetup->getAttribute($type, $row['code']);
            $label = isset($row['frontend_labels'])
                ? explode(',', $row['frontend_labels'])[0]
                : $row['label'];
            unset($row['frontend_labels']);
            if (empty($isAttribute)) {
                if (!empty($row['option'])) {
                    $row['option'] = $this->prepareOptions($row['option'], 'add');
                }
                $this->eavSetup->addAttribute($type, $row['code'], $row);
                $attribute = $this->eavConfig->getAttribute($type, $row['code']);
                $attribute->isObjectNew(true);
                $this->eventManager->dispatch(
                    'magento_customercustomattributes_attribute_save',
                    ['attribute' => $attribute]
                );
                $attribute->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => explode(',', $row['used_in_forms']),
                    'store_labels' => [0 => $label]
                ]);
                $attribute->setDataChanges(true);
                $attribute->getResource()->save($attribute);
                $this->saveDefaultValue($attribute, $row);
            }
        }
    }

    /**
     * Prepare attribute`s option array
     * For new options, the string value of the key should be used, such as: '"option_" . $tmpOption[0]'
     *
     * @param $option
     * @param $type
     *
     * @return array
     */
    protected function prepareOptions($option, $type)
    {
        $formattedOptions = ['value' => []];
        if ($newOption = unserialize($option)) {
            foreach ($newOption as $key => $tmpOption) {
                if ($type == 'add') {
                    $formattedOptions["option_{$key}"] = $tmpOption;
                }
            }
            $formattedOptions['value'] = $formattedOptions;
        }

        return $formattedOptions;
    }
}
