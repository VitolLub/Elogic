<?php
namespace Elogic\TestUnit\Model;
class Vendor extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'elogic_testunit_vendor';

    protected $_cacheTag = 'elogic_testunit_vendor';

    protected $_eventPrefix = 'elogic_testunit_vendor';

    protected function _construct()
    {
        $this->_init('Elogic\TestUnit\Model\ResourceModel\Vendor');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
