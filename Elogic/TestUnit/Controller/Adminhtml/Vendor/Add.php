<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\HttpPostActionInterface;
use \Magento\Framework\App\Action\Action;

class Add extends Action implements HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * @var \Elogic\TestUnit\Model\VendorFactory
     */
    private \Elogic\TestUnit\Model\VendorFactory $vendorFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Elogic\TestUnit\Model\VendorFactory $vendorFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Elogic\TestUnit\Model\VendorFactory $vendorFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->vendorFactory = $vendorFactory;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/adminhtml/layout/elogic_testunit_vendor_add.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            //get request from add page
            $data = (array)$this->getRequest()->getPost();
            //if request available
            if ($data) {
                //get img url from data
                $img_url = $data['icon'][0]['url'];
                $data['thumbnail'] = $img_url;
                $model = $this->vendorFactory->create();
                //set data in to db
                $model->setData($data)->save();
                //show message if correct
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        //generate page after make all code make all operations
        $resultRedirect = $this->resultPageFactory->create();
        return $resultRedirect;
    }

    /**
     * Determines whether current user is allowed to access Action
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_TestUnit::vendor_add');
    }
}
