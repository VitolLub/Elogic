<?php
namespace Elogic\TestUnit\Setup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
class InstallData implements InstallDataInterface
{
		private $eavConfig;

	public function __construct(
		\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
		\Magento\Eav\Model\Config $eavConfig
	) {
		$this->eavSetupFactory = $eavSetupFactory;
		$this->eavConfig = $eavConfig;
	}
/**
* @var EavSetupFactory
 */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'vendor');

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'vendor',
        [
            'group' => 'General',
            'type' => 'int',
            'label' => 'Vendor',
            'input' => 'select',
            'source' => 'Elogic\TestUnit\Model\Attribute\Source\Vendor',
            'frontend' => 'Elogic\TestUnit\Model\Attribute\Frontend\Vendor',
            'backend' => 'Elogic\TestUnit\Model\Attribute\Backend\Vendor',
            'required' => false,
            'sort_order' => 5,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'used_in_product_listing'=> true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'visible' => true,
            'is_html_allowed_on_front' => true,
            'visible_on_front' => true
        ]
         );
    }
}
