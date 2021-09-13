<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Post;
class AddVendorImgFieldToCollection implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    public function __construct(
		\Magento\Eav\Model\Config $eavConfig,
        \Magento\Catalog\Model\Config $catalogConfig,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionRes,
		\Magento\Catalog\Api\ProductAttributeRepositoryInterface $productAttributeRepository,
        array $data = []
    )
    {   $this->_collectionRes = $collectionRes;
        $this->_catalogConfig = $catalogConfig;
		$this->productAttributeRepository = $productAttributeRepository;
		$this->_eavConfig = $eavConfig;
    }
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
    {
//      //$this->elogic_testunit_post = "elogic_testunit_post";
        //$this->catalog_product_entity_int = "catalog_product_entity_int";
		//$this->oce_value = "entity_id";
        //$collection->getSelect()->joinLeft(
        //    ['oce'=>$this->catalog_product_entity_int],
        //    'e.entity_id = oce.entity_id',
        //    ['vendor'=>'oce.value']
        //)->where("oce.attribute_id=138");

		 $collection->addAttributeToSelect('*');
		 $collection->addAttributeToSelect('vendor');
		//foreach($collection as $a)
		// {
        //      var_dump($a->getData())."\n";
		// }
		 $collection->joinField('vendor_photo', 'elogic_testunit_post', 'url', "post_id=vendor", null, 'left'); //;
	 //echo $collection->getSelect()->__toString();
    }
}
