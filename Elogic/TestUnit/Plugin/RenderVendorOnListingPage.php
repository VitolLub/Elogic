<?php
declare(strict_types=1);

namespace Elogic\TestUnit\Plugin;

use \Magento\Catalog\Block\Product\AbstractProduct;
use \Magento\Catalog\Model\Product;

/**
 * Plugin for a block
 */
class RenderVendorOnListingPage
{
    /**
     * Need to render our block added on layout for all product types
     *
     * @param AbstractProduct $subject
     * @param string|null $result
     * @param Product $product
     * @return string|null
     */
    public function afterGetProductDetailsHtml(AbstractProduct $subject, ?string $result, Product $product): ?string
    {
        $vendorBlock = $subject->getChildBlock('my_vendor_list');
        if ($vendorBlock) {
            $vendorBlock->setProduct($product);
            return $result . $vendorBlock->toHtml();
        }
        return $result;
    }
}
