<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends AbstractController
{
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $collection = $this->filter->getCollection($this->brandsCollectionFactory->create());
        $collectionSize = $collection->getSize();

        if (!empty($collection)) {
            $collection->delete();
            $this->messageManager->addSuccessMessage(
                __('A total of %1 brand(s) has been deleted.', $collectionSize)
            );
        } else {
            $this->messageManager->addWarningMessage("Please select brands to delete");
        }

        return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
    }
}
