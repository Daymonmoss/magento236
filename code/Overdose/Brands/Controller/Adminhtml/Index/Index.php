<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Brands List'));

        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Overdose_Brands::brands');
    }


}
