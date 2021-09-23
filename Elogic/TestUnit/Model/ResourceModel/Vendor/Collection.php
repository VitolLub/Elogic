<?php
namespace Elogic\TestUnit\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'vendor_id';
    protected $_eventPrefix = 'elog_testunit_vendor_collection';
    protected $_eventObject = 'vendor_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Elogic\TestUnit\Model\Vendor::class,
            \Elogic\TestUnit\Model\ResourceModel\Vendor::class
        );
    }
}
