<?php

namespace Overdose\Adminpanel\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;
use Magento\Cms\Model\Page;
use Magento\Framework\Controller\Result\JsonFactory;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Overdose\AdminPanel\Model\InlineFriendsEditor;
use Overdose\LessonOne\Api\FriendRepositoryInterface;
use Overdose\LessonOne\Model\FriendsFactory;
use Overdose\LessonOne\Model\ResourceModel\Friends as FriendsResourceModel;
use Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory as FriendsCollectionFactory;


/**
 * Friends page grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends AbstractController
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Overdose_AdminPanel::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PostDataProcessor $dataProcessor
     * @param FriendsFactory $friendsFactory
     * @param FriendsResourceModel $friendsResourceModel
     * @param FriendsCollectionFactory $friendsCollectionFactory
     * @param FriendRepositoryInterface $friendRepositoryInterface
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostDataProcessor $dataProcessor,
        FriendsFactory $friendsFactory,
        FriendsResourceModel $friendsResourceModel,
        FriendsCollectionFactory $friendsCollectionFactory,
        FriendRepositoryInterface $friendRepositoryInterface,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context, $friendsFactory, $friendsResourceModel, $friendsCollectionFactory, $friendRepositoryInterface);
        $this->dataProcessor = $dataProcessor;
        $this->jsonFactory = $jsonFactory;
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel= $friendsResourceModel;
        $this->friendsCollectionFactory = $friendsCollectionFactory;
        $this->friendRepositoryInterface = $friendRepositoryInterface;
    }

    /**
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $pageId) {
            /** @var InlineFriendsEditor $page */
            $page = $this->friendRepositoryInterface->getById($pageId);
            try {
                $pageData = $this->filterPost($postItems[$pageId]);
                $this->validatePost($pageData, $page, $error, $messages);
                $extendedPageData = $page->getData();
                $this->setFriendsPageData($page, $extendedPageData, $pageData);
                $this->friendRepositoryInterface->save($page);
            } catch (LocalizedException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPageId(
                    $page,
                    __('Something went wrong while saving the page.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Filtering posted data.
     *
     * @param array $postData
     * @return array
     */
    protected function filterPost($postData = [])
    {
        $pageData = $this->dataProcessor->filter($postData);
        $pageData['custom_theme'] = isset($pageData['custom_theme']) ? $pageData['custom_theme'] : null;
        $pageData['custom_root_template'] = isset($pageData['custom_root_template'])
            ? $pageData['custom_root_template']
            : null;
        return $pageData;
    }

    /**
     * Validate post data
     *
     * @param array $pageData
     * @param Page $page
     * @param bool $error
     * @param array $messages
     * @return void
     */
    protected function validatePost(array $pageData, InlineFriendsEditor $page, &$error, array &$messages)
    {
        if (!($this->dataProcessor->validate($pageData) && $this->dataProcessor->validateRequireEntry($pageData))) {
            $error = true;
            foreach ($this->messageManager->getMessages(true)->getItems() as $error) {
                $messages[] = $this->getErrorWithPageId($page, $error->getText());
            }
        }
    }

    /**
     * Add page title to error message
     *
     * @param InlineFriendsEditor$page
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPageId(InlineFriendsEditor $page, $errorText)
    {
        return '[Page ID: ' . $page->getId() . '] ' . $errorText;
    }

    /**
     * Set cms page data
     *
     * @param Page $page
     * @param array $extendedPageData
     * @param array $pageData
     * @return $this
     */
    public function setFriendsPageData(InlineFriendsEditor $page, array $extendedPageData, array $pageData)
    {
        $page->setData(array_merge($page->getData(), $extendedPageData, $pageData));
        return $this;
    }
}
