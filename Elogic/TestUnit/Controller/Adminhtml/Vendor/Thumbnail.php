<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{

    protected $collectionFactory;
    protected $postFactory;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Elogic\TestUnit\Model\VendorFactory $vendorFactory,
        array $components = [], array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        $this->vendorFactory = $vendorFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {

        //receive all data from grid
        foreach ($dataSource['data']['items'] as & $item){
            //check if product have vendor id attribute
            if(isset($item['vendor'])){
                //get product name for src and alt
                $fieldName = $this->getData('name');
                //remove all space from vendor
                $vendor_id = trim($item['vendor']);
                $product = $this->vendorFactory->create()->load($vendor_id, 'vendor_id')->getData();
                $item[$fieldName . '_src'] = $product['thumbnail'];
            }
        }
        return $dataSource;
    }
}
