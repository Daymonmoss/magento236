<?php

namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Overdose\Brands\Model\BrandsModel;
use Overdose\Brands\Model\BrandsModelFactory;

class Edit extends AbstractController implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Overdose_Brands::index_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Edit Friend;
     * @return Page|Redirect|ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @var BrandsModelFactory $brandsModelFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $brandsModelFactory = $this->_objectManager->create(BrandsModel::class);

        if ($id) {
            $brandsModelFactory->load($id)->setData('brand_name', 'brand_title');

            if (!$brandsModelFactory->getId()) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }

        }

        $resultPage = $this->resultFactory->create('page');
        /** @var Page $resultPage */
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Brand'));
        $resultPage->getConfig()->getTitle()
        ->prepend($brandsModelFactory->getId() ? $brandsModelFactory->getTitle() : __('New Brand'));

        return $resultPage;
    }
}
