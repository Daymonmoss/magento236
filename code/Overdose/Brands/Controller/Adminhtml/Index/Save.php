<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Overdose\Brands\Api\Data\BrandsInterface;

class Save extends AbstractController implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Brand'),
            'class' => 'primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'overdose_brands_form.overdose_brands_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'continue'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'sort_order' => 30
        ];
    }

    public function execute()
    {
        $redirect = $this->resultFactory->create('redirect');

        try {
            $data = $this->getRequest()->getPostValue();

            /** @var BrandsInterface $model */
            $model = $this->brandsModelFactory->create();

            $postData = !empty($data['brand']) ? $data['brand'] : [];

            if (!empty($postData['id'])) {
                try {
                    $model = $this->brandsRepositoryInterface->getById((int)$postData['id']);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This brand no longer exists.'));
                    return $redirect->setPath(self::DEFAULT_ACTION_PATH);
                }
            }

            $model->setBrandName($postData['brand_name'])
                  ->setBrandTitle($postData['brand_title']);

            $this->friendRepositoryInterface->save($model);

            $newFriendId = $model->getId();

            $this->messageManager->addSuccessMessage(__("Yay! Now you have a new brand! Successfully saved to the database!"));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index', ['id' => $newFriendId]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Sorry, was unable to save a brand form. =("));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
        }

        return $redirect;
    }
}
