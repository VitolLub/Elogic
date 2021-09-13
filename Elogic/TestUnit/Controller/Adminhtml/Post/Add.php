<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Post;

class Add extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    protected $resultPageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Elogic\TestUnit\Model\PostFactory $postFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/adminhtml/layout/samplenewpage_sampleform_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
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
}
