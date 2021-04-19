<?php
namespace Overdose\Brands\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\Collection;

class Brand extends AbstractSource
{
    protected $_options;

    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            /** @var Collection $collection */
            $collection = $this->collectionFactory->create();

            $brands = $collection->getItems();

            if (!$brands) {
                return [];
            }

            $options = [];

            foreach ($brands as $brand) {
                $options[] = [
                    'label' => $brand->getData('brand_name'),
                    'value' => $brand->getData('id')
                ];
            }

            $this->_options = $options;
        }

        return $this->_options;
    }
}
