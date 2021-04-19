<?php
namespace Overdose\Brands\Model\Attribute\Frontend;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Store\Model\StoreManagerInterface;

class Brand extends AbstractFrontend
{
    /**
     * @var Config
     */
    protected $eavConfig;

    public function __construct(
        BooleanFactory $attrBooleanFactory,
        CacheInterface $cache = null,
        $storeResolver = null,
        array $cacheTags = null,
        StoreManagerInterface $storeManager = null,
        Serializer $serializer = null,
        Config $eavConfig
    ) {
        parent::__construct($attrBooleanFactory, $cache, $storeResolver, $cacheTags, $storeManager, $serializer);
        $this->eavConfig = $eavConfig;
    }

    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        $attributeCode = $this->getAttribute()->getAttributeCode();
        $attributeDetails = $this->eavConfig->getAttribute("catalog_product", $attributeCode);

        return $attributeDetails->getSource()->getOptionText($value);
    }
}
