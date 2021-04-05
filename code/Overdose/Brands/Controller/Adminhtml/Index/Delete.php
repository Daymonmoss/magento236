<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Overdose\Brands\Model\BrandsModel;
use Overdose\Brands\Model\BrandsModelFactory;

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
                    'Are you sure this is not popular brand?'
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
    * so that this controller can delete the 'brand' record by 'id' in the url.
    ** @var BrandsModelFactory $brandsModelFactory
    * @return ResponseInterface|ResultInterface
    */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $id = $this->getRequest()->getParam('id', null);

        if ($id) {
            try {
                $brandsModelFactory = $this->_objectManager->create(BrandsModel::class);
                $brandsModelFactory->load($id);
                $brandsModelFactory->delete();
                $this->messageManager->addSuccessMessage(__("Yay. You have deleted the brand!!"));
                return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__("Was unable to delete this unpopular brand. =("));
                return $redirect->setPath('*/*/edit' . ['page_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find this brand to delete.'));
        return $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
    }
}
