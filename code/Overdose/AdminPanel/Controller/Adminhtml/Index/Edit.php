<?php

namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Overdose\LessonOne\Model\Friends;

use Overdose\LessonOne\Model\FriendsFactory;

class Edit extends AbstractController implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Overdose_AdminPanel::index_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    // TODO: Implement edit of existing record. OR of a new one, if there is no 'id' param in the url.

    // TODO: go see vendor/magento/module-cms/Controller/Adminhtml/Page/Edit.php::execute() for an example
    /**
     * Edit Friend;
     * @return Page|Redirect|ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     *@var FriendsFactory $friendsFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $friendsFactory = $this->_objectManager->create(Friends::class);

        // 2. Initial checking
        if ($id) {
            $friendsFactory->load($id)
                 ->setData('name', 'age', 'comment');
            if (!$friendsFactory->getId()) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                //               /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 5. Build edit form
        $resultPage = $this->resultFactory->create('page');
        /** @var Page $resultPage */
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Friend'));
        $resultPage->getConfig()->getTitle()
        ->prepend($friendsFactory->getId() ? $friendsFactory->getTitle() : __('New Friend'));

        return $resultPage;
    }
}
