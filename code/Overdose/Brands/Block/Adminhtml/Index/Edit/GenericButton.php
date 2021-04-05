<?php

namespace Overdose\Brands\Block\Adminhtml\Index\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use Overdose\Brands\Api\BrandsRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var BrandsRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        BrandsRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return Brand ID
     *
     * @return int|null
     */
    public function getStatusId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
