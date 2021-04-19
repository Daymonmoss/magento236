<?php
namespace Overdose\Brands\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Overdose\Brands\Api\Data\BrandsInterface;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $brandsCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $brandsCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $brandsCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /** {@inheritDoc} */
    public function getData() : array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $brands = $this->collection->getItems();

        if (empty($brands)) {
            return [];
        }

        /** @var $brand BrandsInterface */
        foreach ($brands as $brand) {
            $this->loadedData[$brand->getId()]['brand']  = $brand->getData();
        }

        return $this->loadedData;
    }
}
