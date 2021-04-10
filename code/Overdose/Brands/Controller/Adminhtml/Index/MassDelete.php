<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

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
                    $this->brandsRepositoryInterface->deleteById($id);
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__('Brand with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 brand(s) has been deleted.', count($ids))
            );
        } else {
            $this->messageManager->addWarningMessage("Please select brands to delete");
        }

        return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
    }
}
