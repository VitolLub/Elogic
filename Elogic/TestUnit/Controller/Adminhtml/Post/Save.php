<?php

namespace Elogic\TestUnit\Controller\Adminhtml\Post;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class Save implements \Magento\Framework\Option\ArrayInterface
{

    protected $postFactory;
    public function __construct(
        \Elogic\TestUnit\Model\PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {

                $img_url = $data['icon'][0]['url'];
                $data['url'] = $img_url;
                $model = $this->postFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $this->_view->loadLayout();
        $this->_view->getLayout()->getBlock('add');
        $this->_view->renderLayout();
    }
    public function toOptionArray()
    {
        $collection = $this->postFactory->create()->getCollection();
        $options = [];
        foreach ($collection as $value) {
            $options[] = ['label' => $value->getName(), 'value'=>$value->getId()];
        }
        return $options;
    }


}
