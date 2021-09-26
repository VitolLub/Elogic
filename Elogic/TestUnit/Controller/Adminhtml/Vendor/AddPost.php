<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

use \Magento\Backend\App\Action\Context;
use \Magento\Backend\App\Action;
use \Elogic\TestUnit\Model\VendorFactory;
use \Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\App\Action\HttpPostActionInterface;
use \Magento\Backend\Model\View\Result\Redirect as ResultRedirect;

class AddPost extends Action implements HttpPostActionInterface
{
    /**
     * @var VendorFactory
     */
    private VendorFactory $vendorFactory;

    /**
     * @param Context $context
     * @param VendorFactory $vendorFactory
     */
    public function __construct(
        Context $context,
        VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
    }
    /**
     * Save vendor
     *
     * @return ResultRedirect
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
        /** @var ResultRedirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath(
            '*/*/index'
        );
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
