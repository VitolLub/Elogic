<?php
namespace Elogic\TestUnit\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'elogic_testunit_post';

    protected $_cacheTag = 'elogic_testunit_post';

    protected $_eventPrefix = 'elogic_testunit_post';

    protected function _construct()
    {
        $this->_init('Elogic\TestUnit\Model\ResourceModel\Post');
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
