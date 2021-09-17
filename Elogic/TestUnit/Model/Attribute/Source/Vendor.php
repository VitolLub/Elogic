<?php

namespace Elogic\TestUnit\Model\Attribute\Source;

use \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use \Magento\Framework\Option\ArrayInterface;

class Vendor extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    protected $vendorFactory;
    public function __construct(
        \Elogic\TestUnit\Model\VendorFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {

        $collection = $this->vendorFactory->create()->getCollection();
        $options = [];
        foreach ($collection as $value) {
            $options[] = ['label' => __($value->getTitle()), 'value'=>$value->getId()];
        }
        if (!$this->_options) {
            $this->_options = $options;
        }
        return $this->_options;
    }


}
