<?php

namespace Overdose\Plug\Plugin;

class AroundPlugin
{
    public function aroundGetName(\Overdose\Plug\ViewModel\Newview $subject, \Closure $proceed, $arg1, $arg2): string
    {
        //Before plugin
        $arg1 = "After";

        $originFunctionResult = $proceed($arg1, $arg2);
        //After plugin
        $arg2 = "Before";

        $originFunctionResult = $arg1 . "<--" . $arg2;

        return $originFunctionResult;
    }
}
