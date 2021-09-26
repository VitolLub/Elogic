<?php
declare(strict_types=1);

namespace Elogic\TestUnit\Ui\Component\Listing\Columns;

use \Elogic\TestUnit\Model\ResourceModel\Vendor\Collection;
use \Elogic\TestUnit\Model\ResourceModel\Vendor\CollectionFactory;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;

class ProductListThumbnail extends Column
{
    /**
     * VendorsCollectionClass
     */
    private Collection $vendorsCollection;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CollectionFactory $vendorCollectionFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $vendorCollectionFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->vendorsCollection = $vendorCollectionFactory->create();
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        $fieldName = $this->getData('name');
        $vendorCollection = $this->getVendorsCollection($dataSource);
        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($item['vendor']) && (int)$item['vendor']) {
                $vendor = $vendorCollection->getItemById((int)$item['vendor']);
                if ($vendor) {
                    $item[$fieldName . '_src'] = $vendor->getThumbnail();
                    $item[$fieldName . '_orig_src'] = $vendor->getThumbnail();
                    $item[$fieldName . '_alt'] = $fieldName;
                }
            }
        }
        return $dataSource;
    }

    /**
     * Get vendor collection
     *
     * @param array $dataSource
     * @return Collection
     */
    private function getVendorsCollection(array $dataSource): Collection
    {
        if (!$this->vendorsCollection->isLoaded()) {
            $vendorIds = [0];
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['vendor'])) {
                    $vendorId = (int)$item['vendor'];
                    if ($vendorId) {
                        $vendorIds[] = $vendorId;
                    }
                }
            }
            $this->vendorsCollection->addFieldToFilter('vendor_id', ['in' => $vendorIds]);
        }
        return $this->vendorsCollection;
    }
}
