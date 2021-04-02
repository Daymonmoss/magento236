<?php

namespace Overdose\AdminPanel\Controller\Adminhtml\Index;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends AbstractController implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'class' => 'back',
            'on_click' => sprintf("location.href = '%s';", $this->execute()),
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    public function execute()
    {
        return $this->getUrl('*/*/');
    }
}
