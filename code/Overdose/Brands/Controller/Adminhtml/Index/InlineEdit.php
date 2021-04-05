<?php

namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;
use Magento\Cms\Model\Page;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Overdose\Brands\Model\InlineBrandsEditorModel;
use Overdose\Brands\Api\BrandsRepositoryInterface;
use Overdose\Brands\Model\BrandsModelFactory;
use Overdose\Brands\Model\BrandsResource\ResourceModel;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;


/**
 * Brands page grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends AbstractController
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Overdose_Brands::save';

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
     * @param BrandsModelFactory $brandsModelFactory
     * @param ResourceModel $brandsResourceModel
     * @param CollectionFactory $brandsCollectionFactory
     * @param BrandsRepositoryInterface $brandsRepositoryInterface
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostDataProcessor $dataProcessor,
        BrandsModelFactory $brandsModelFactory,
        ResourceModel $brandsResourceModel,
        CollectionFactory $brandsCollectionFactory,
        BrandsRepositoryInterface $brandsRepositoryInterface,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context, $brandsModelFactory, $brandsResourceModel, $brandsCollectionFactory, $brandsRepositoryInterface);
        $this->dataProcessor = $dataProcessor;
        $this->jsonFactory = $jsonFactory;
        $this->brandsModelFactory = $brandsModelFactory;
        $this->brandsResourceModel= $brandsResourceModel;
        $this->brandsCollectionFactory = $brandsCollectionFactory;
        $this->brandsRepositoryInterface = $brandsRepositoryInterface;
    }

    /**
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var Json $resultJson */
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
            /** @var InlineBrandsEditor $page */
            $page = $this->brandsRepositoryInterface->getById($pageId);
            try {
                $pageData = $this->filterPost($postItems[$pageId]);
                $this->validatePost($pageData, $page, $error, $messages);
                $extendedPageData = $page->getData();
                $this->setBrandsPageData($page, $extendedPageData, $pageData);
                $this->brandsRepositoryInterface->save($page);
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
    protected function validatePost(array $pageData, InlineBrandsEditor $page, &$error, array &$messages)
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
     * @param InlineBrandsEditor$page
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPageId(InlineBrandsEditor $page, $errorText)
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
    public function setFriendsPageData(InlineBrandsEditor $page, array $extendedPageData, array $pageData)
    {
        $page->setData(array_merge($page->getData(), $extendedPageData, $pageData));
        return $this;
    }
}
