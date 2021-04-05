<?php


namespace Overdose\Brands\Block\Adminhtml\Index\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;


class Save extends GenericButton implements ButtonProviderInterface
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
}
