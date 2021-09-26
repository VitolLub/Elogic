<?php
declare(strict_types=1);

namespace Elogic\TestUnit\Ui\Component\Listing\Columns;

use \Magento\Ui\Component\Listing\Columns\Column;

class VendorThumbnail extends Column
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        $fieldName = $this->getData('name');
        foreach ($dataSource['data']['items'] as &$item) {
            //check if product have vendor id attribute
            if (isset($item['thumbnail'])) {
                $item[$fieldName . '_src'] = $item['thumbnail'];
                $item[$fieldName . '_orig_src'] = $item['thumbnail'];
                $item[$fieldName . '_alt'] = $fieldName;
            }
        }
        return $dataSource;
    }
}
