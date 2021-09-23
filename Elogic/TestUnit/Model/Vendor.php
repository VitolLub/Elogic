<?php

namespace Elogic\TestUnit\Model;

class Vendor extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * Constants
     */
    const CACHE_TAG = 'elogic_testunit_vendor';

    /**
     * @var string
     */
    protected $_cacheTag = 'elogic_testunit_vendor';

    /**
     * @var string
     */
    protected $_eventPrefix = 'elogic_testunit_vendor';

    /**
     * Model init
     */
    protected function _construct()
    {
        $this->_init(\Elogic\TestUnit\Model\ResourceModel\Vendor::class);
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
