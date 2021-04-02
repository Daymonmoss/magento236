<?php
namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Overdose\LessonOne\Model\Friends;
use Overdose\LessonOne\Model\FriendsFactory;

class Delete extends AbstractController implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getRequest()->getParam('id', null) !== null) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure this is bad friend?'
                ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getRequest()->getParam('id', null)]);
    }

    /**
    * Figure out how to redirect an admin user to this controller with the id/*some_id_number_here*,
    * so that this controller can delete the 'friend' record by 'id' in the url.
     **@var FriendsFactory $friendsFactory
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $id = $this->getRequest()->getParam('id', null);

        if ($id) {
            try {
                $friendsFactory = $this->_objectManager->create(Friends::class);
                $friendsFactory->load($id);
                // TODO: Implement deleting of existing record.
                // TODO: Huh, looks like all those repositories and/or resourceModels can come in handy here.
                // TODO: go see vendor/magento/module-cms/Controller/Adminhtml/Page/Delete.php::execute() for an example
                $friendsFactory->delete();
                $this->messageManager->addSuccessMessage(__("Yay. You have deleted a friend!!"));
                return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__("Was unable to delete your friend. =("));
                return $redirect->setPath('*/*/edit' . ['page_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a friend to delete.'));
        return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
    }
}
