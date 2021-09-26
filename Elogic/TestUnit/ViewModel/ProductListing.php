<?php
declare(strict_types=1);

namespace Elogic\TestUnit\ViewModel;

use \Magento\Framework\View\Element\Block\ArgumentInterface;
use \Elogic\TestUnit\Model\Vendor;
use \Elogic\TestUnit\Model\ResourceModel\Vendor\Collection;
use \Elogic\TestUnit\Model\ResourceModel\Vendor\CollectionFactory;
use \Magento\Catalog\Model\Layer;
use \Magento\Catalog\Model\Layer\Resolver;

class ProductListing implements ArgumentInterface
{
    /**
     * @var Layer
     */
    private Layer $layer;

    /**
     * VendorsCollectionClass
     */
    private Collection $vendorsCollection;

    /**
     * @param Resolver $layerResolver
     * @param CollectionFactory $vendorCollectionFactory
     */
    public function __construct(
        Resolver $layerResolver,
        CollectionFactory $vendorCollectionFactory
    ) {
        $this->layer = $layerResolver->get();
        $this->vendorsCollection = $vendorCollectionFactory->create();
    }

    /**
     * Get vendor to be processed in template
     *
     * @param int $vendorId
     * @return Vendor|null
     */
    public function getVendor(int $vendorId): ?Vendor
    {
        return $this->getVendorsCollection()->getItemById($vendorId);
    }

    /**
     * Get vendor collection
     *
     * @return Collection
     */
    private function getVendorsCollection(): Collection
    {
        if (!$this->vendorsCollection->isLoaded()) {
            $vendorIds = [0];
            foreach ($this->layer->getProductCollection() as $product) {
                $vendorId = (int)$product->getVendor();
                if ($vendorId) {
                    $vendorIds[] = $vendorId;
                }
            }
            $this->vendorsCollection->addFieldToFilter('vendor_id', ['in' => $vendorIds]);
        }
        return $this->vendorsCollection;
    }
}
