<?php

namespace Overdose\Plug\Plugin;

class AfterPlugin
{
    public function afterSimpleTextToTheShell()
    {
        return "Now this text came from the after plugin, and NOT the viewModel class.";
    }
}
