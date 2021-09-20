<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

class Add extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    protected $resultPageFactory;
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
     * Load the page defined in view/adminhtml/layout/samplenewpage_sampleform_index.xml
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

}
