<?php
declare(strict_types=1);
namespace Overdose\Plug\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Event\ManagerInterface;

class Index extends Action
{
    /**
     * @var Http|RequestInterface
     */
    private $request;

    /**
     * @var ManagerInterface
     */
    private $eventManager;

    /**
     * @param Context $context
     * @param ManagerInterface $eventManager
     * @param Http $request
     */
    public function __construct(
        Context $context,
        ManagerInterface $eventManager,
        Http $request
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->eventManager = $eventManager;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($this->request->getPathInfo() == '/plug/index/index') {
            $this->eventManager->dispatch(
                'plug_event',
                ['plug_index_die' => $page]
            );
        }

        return $page;
    }
}
