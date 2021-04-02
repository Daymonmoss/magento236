<?php
namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends AbstractController
{
    /** {@inheritdoc} */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $ids = $this->getRequest()->getParam('selected');
        if (!empty($ids)) {
            foreach ($ids as $id) {
                try {
                    $this->friendRepositoryInterface->deleteById($id);
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__('Friend with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 friend(s) has been deleted.', count($ids))
            );
        } else {
            $this->messageManager->addWarningMessage("Please select friends to delete");
        }

        return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
    }
}
