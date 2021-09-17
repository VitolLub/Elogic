<?php
namespace Elogic\TestUnit\Model\ResourceModel;


class Vendor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('elogic_testunit_vendor', 'vendor_id');
    }

}
