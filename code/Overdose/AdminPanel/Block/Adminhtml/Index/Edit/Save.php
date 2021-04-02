<?php


namespace Overdose\AdminPanel\Block\Adminhtml\Index\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;


class Save extends GenericButton implements ButtonProviderInterface
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
}
