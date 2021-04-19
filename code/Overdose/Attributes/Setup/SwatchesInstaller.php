<?php
namespace Overdose\Attributes\Setup;

use Magento\Framework\Setup;
use Overdose\Attributes\Model\Swatches;

class SwatchesInstaller implements Setup\SampleData\InstallerInterface
{
    /**
     * @var Swatches;
     */
    protected $swatches;

    /**
     * @param Swatches $swatches
     */
    public function __construct(Swatches $swatches)
    {
        $this->swatches = $swatches;
    }

    /**
     * @inheritdoc
     */
    public function install()
    {
        $this->swatches->install();
    }
}
