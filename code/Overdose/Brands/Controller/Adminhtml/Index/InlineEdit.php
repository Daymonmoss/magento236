<?php

namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Overdose\Brands\Api\Data\BrandsInterface;
use Overdose\Brands\Model\BrandsModel;


/**
 * Brands brand grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends AbstractController
{
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
                foreach (array_keys($postItems) as $brandId) {
                    /** @var BrandsModel $brand */
                    $brand = $this->brandsRepository->getById($brandId);
                    try {
                        $brand->setData(array_merge($brand->getData(), $postItems[$brandId]));
                        $this->brandsRepository->save($brand);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBrandId(
                            $brand,
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
     * @param BrandsInterface $brand
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBrandId(BrandsInterface $brand, $errorText)
    {
        return '[Brand ID: ' . $brand->getId() . '] ' . $errorText;
    }
}
