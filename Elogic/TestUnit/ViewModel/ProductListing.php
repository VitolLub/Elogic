<?php
namespace Elogic\TestUnit\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
class ProductListing implements ArgumentInterface
{
    private $layerResolver;
    public function __construct(
        \Magento\Catalog\Model\Layer\Resolver $layerResolver
    )
    {
        $this->layerResolver = $layerResolver;
    }
    public function getVendor(int $vendorId)
    {
        return $this->getVendorsCollection()->getById($vendorId);
    }

    private function getVendorsCollection()
    {
        if (!$this->vendorsCollection) {
            $vendorIds = [0];
            $this->layer = $layerResolver->get();
            foreach ($this->layer->getProductCollection() as $product) {
                $vendorIds[] = (int)$product->getVendorId();
            }
            $this->vendorsCollection = $this->vendorCollectionFactory()->create()
                ->addFieldToFilter('vendor_id IN (?)', $vendorIds);
        }
        return $this->vendorsCollection;
    }

}
