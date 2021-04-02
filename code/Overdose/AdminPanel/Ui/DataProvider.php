<?php
namespace Overdose\AdminPanel\Ui;

use Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param FriendsFactory $friendsCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        FriendsFactory $friendsCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $friendsCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $friends = $this->collection->getItems();
        $this->loadedData = [];

        foreach ($friends as $friend) {
            $this->loadedData[$friend->getId()]['friend'] = $friend->getData();
        }

        return $this->loadedData;
    }
}
