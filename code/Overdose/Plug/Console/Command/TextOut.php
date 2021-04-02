<?php

namespace Overdose\Plug\Console\Command;

use Magento\Framework\Console\Cli;
use Magento\Store\Model\StoreManagerInterface;
use Overdose\Plug\ViewModel\Newview;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StoreListCommand
 *
 * Command for listing the configured stores
 */
class TextOut extends Command
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Newview
     */
    private $viewModel;

    /**
     * @param StoreManagerInterface $storeManager
     * @param Newview $viewModel
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        Newview $viewModel
    ) {
        $this->storeManager = $storeManager;
        $this->viewModel = $viewModel;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('plug:simpletext')
            ->setDescription('Display in the CLI simple text from simpleTextToTheShell() function of Newview class');

        parent::configure();
    }

    /**
     * {@inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln($this->viewModel->simpleTextToTheShell());
            return Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }

            return Cli::RETURN_FAILURE;
        }
    }
}
