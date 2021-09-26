<?php

namespace Elogic\TestUnit\Model\Attribute\Source;

use \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use \Elogic\TestUnit\Model\Vendor as VendorModel;
use \Elogic\TestUnit\Model\ResourceModel\Vendor\Collection;
use \Elogic\TestUnit\Model\ResourceModel\Vendor\CollectionFactory;

class Vendor extends AbstractSource
{
    /**
     * VendorsCollectionClass
     */
    private Collection $vendorsCollection;

    /**
     * @param CollectionFactory $vendorCollectionFactory
     */
    public function __construct(
        CollectionFactory $vendorCollectionFactory
    ) {
        $this->vendorsCollection = $vendorCollectionFactory->create();
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Please select a value'), 'value' => 0]
            ];
            foreach ($this->vendorsCollection as $vendorModel) {
                /* @var $vendorModel VendorModel */
                $this->_options[] = ['label' => __($vendorModel->getTitle()), 'value' => $vendorModel->getId()];
            }
        }
        return $this->_options;
    }
}
