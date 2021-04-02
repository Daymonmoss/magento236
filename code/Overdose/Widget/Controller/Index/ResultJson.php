<?php

namespace Overdose\Widget\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Translate\Inline\ParserInterface;

class ResultJson extends Action
{
    /**
     * @var ParserInterface
     */
    protected $inlineParser;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param ParserInterface $inlineParser
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        ParserInterface $inlineParser,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->inlineParser = $inlineParser;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        $response = ['success' => 'true', 'data' => ['friend_name' => 'Semen', 'friend_age' => 33]];
        $resultJson->setData($response);

        return $resultJson;
    }

}
