<?php

namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Elogic\TestUnit\Model\VendorFactory $vendorFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_vendorFactory = $vendorFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));

        return $resultPage;

    }


}
