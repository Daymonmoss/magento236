<?php

namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Overdose\LessonOne\Api\FriendRepositoryInterface;
use Overdose\LessonOne\Api\Data\FriendInterface;
use Overdose\LessonOne\Model\Friends;

/**
 * Friends grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends AbstractController
{

    /**
     * @var FriendRepositoryInterface
     */
    protected $friendRepository;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * Process the request
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $friendId) {
                    /** @var Friends $friend */
                    $friend = $this->friendRepository->getById($friendId);
                    try {
                        $friend->setData(array_merge($friend->getData(), $postItems[$friendId]));
                        $this->friendRepository->save($friend);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithFriendId(
                            $friend,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add brand title to error message
     *
     * @param FriendInterface $friend
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithFriendId(FriendInterface $friend, $errorText)
    {
        return '[Friend ID: ' . $friend->getId() . '] ' . $errorText;
    }
}
