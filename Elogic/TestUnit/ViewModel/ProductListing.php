<?php
namespace Elogic\TestUnit\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
class ProductListing implements ArgumentInterface
{
    protected $_product;

    public function __construct(
        \Elogic\TestUnit\Model\PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
    }
    public function getVendorDescription($vendorId)
    {
        //load venor description and name by post_id
        $vendor_collection = $this->_postFactory->create()->load($vendorId, 'post_id')->getData();
        return $vendor_collection;
    }

}
