<?php

namespace Elogic\TestUnit\Model\Attribute\Source;

use \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use \Magento\Framework\Option\ArrayInterface;

class Vendor extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    protected $postFactory;
    public function __construct(
        \Elogic\TestUnit\Model\PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
    }

    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        $collection = $this->postFactory->create()->getCollection();
        $options = [];
        foreach ($collection as $value) {
            $options[] = ['label' => __($value->getName()), 'value'=>$value->getId()];
        }
        if (!$this->_options) {
            $this->_options = $options;
        }
        return $this->_options;
    }


}
