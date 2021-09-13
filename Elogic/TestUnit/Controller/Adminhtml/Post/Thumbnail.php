<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Post;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;

class Thumbnail extends Column
{

    protected $_orderRepository;
    protected $_searchCriteria;
    protected $_customfactory;
    protected $collectionFactory;
    protected $postFactory;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $criteria,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Elogic\TestUnit\Model\PostFactory $postFactory,
        array $components = [], array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        $this->resource = $resource;
        $this->orderFactory = $orderFactory;
        $this->postFactory = $postFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {

        foreach ($dataSource['data']['items'] as & $item){
            if(isset($item['vendor'])){
				$fieldName = $this->getData('name');
                $post_id = trim($item['vendor']);
                $product = $this->postFactory->create()->load($post_id, 'post_id')->getData();
                $item[$fieldName . '_src'] = $product['url'];
            }
        }
        return $dataSource;
    }
}
