<?php
namespace Elogic\TestUnit\Controller\Adminhtml\Vendor;

use \Magento\Backend\App\Action;
use \Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Backend\Model\View\Result\Page as ResultPage;

class Add extends Action implements HttpGetActionInterface
{
    /**
     * Render form
     *
     * @return ResultPage
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
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
