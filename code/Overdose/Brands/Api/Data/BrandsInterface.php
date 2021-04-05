<?php
namespace Overdose\Brands\Api\Data;

use Overdose\Brands\Model\BrandsModel;

interface BrandsInterface
{
    const TABLE_NAME = 'overdose_brands';

    const FIELD_NAME_ID = 'id';
    const FIELD_NAME_NAME = 'brand_name';
    const FIELD_NAME_TITLE = 'brand_title';

    /**
    * @return integer
    */
    public function getId();

    /**
    * @return string
    */
    public function getBrandName();

    /**
    * @param string $brandName
    * @return BrandsInterface|BrandsModel
    */
    public function setBrandName($brandName);

    /**
    * @return string
    */
    public function getBrandTitle();

    /**
    * @param string $brandTitle
    * @return BrandsInterface|BrandsModel
    */
    public function setBrandTitle($brandTitle);
}
