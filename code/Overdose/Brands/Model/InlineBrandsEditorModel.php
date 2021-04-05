<?php

namespace Overdose\Brands\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime;
use Overdose\Brands\Api\Data\BrandsInterface;
use Overdose\Brands\Model\BrandsResource\ResourceModel;

class InlineBrandsEditorModel extends AbstractModel implements BrandsInterface, IdentityInterface
{
    /**
     * No route page id
     */
    const NOROUTE_PAGE_ID = 'no-route';

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", "brands", $this->getId())];
    }

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $this->setData(BrandsInterface::FIELD_NAME_ID, $id);

        return $this;
    }
    /** {@inheritdoc} */
    public function getBrandName()
    {
        return $this->getData(BrandsInterface::FIELD_NAME_NAME);
    }

    /** {@inheritdoc} */
    public function setBrandName($brandName)
    {
        $this->setData(BrandsInterface::FIELD_NAME_NAME, $brandName);

        return $this;
    }
    /** {@inheritdoc} */
    public function getBrandTitle()
    {
        return $this->getData(BrandsInterface::FIELD_NAME_TITLE);
    }

    /** {@inheritdoc} */
    public function setBrandTitle($brandTitle)
    {
        $this->setData(BrandsInterface::FIELD_NAME_TITLE, $brandTitle);

        return $this;
    }
}

