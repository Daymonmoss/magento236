<?php
namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Overdose\LessonOne\Api\Data\FriendInterface;

class Save extends AbstractController implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Friend'),
            'class' => 'primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'overdose_friends_form.overdose_friends_form',
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

            // TODO: Implement saving of existing record.
            // TODO: Huh, looks like all those repositories or resourceModels can come in handy here.
            // TODO: Implement a loading here.

            /** @var FriendInterface $model */
            $model = $this->friendsFactory->create();

            $postData = !empty($data['friend']) ? $data['friend'] : [];

            if (!empty($postData['id'])) {
                try {
                    $model = $this->friendRepository->getById((int)$postData['id']);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This friend no longer exists.'));
                    return $redirect->setPath(self::DEFAULT_ACTION_PATH);
                }
            }

            $model->setName($postData['name'])
                ->setAge((int)$postData['age'])
                ->setComment($postData['comment']);

            $this->friendRepository->save($model);

            $newFriendId = $model->getId();

            $this->messageManager->addSuccessMessage(__("Yay. Now you have a new friend! Successfully saved to the database!"));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index', ['id' => $newFriendId]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Sorry, was unable to save a friend form. =("));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
        }

        return $redirect;
    }
}
