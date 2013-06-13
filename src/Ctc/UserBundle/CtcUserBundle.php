<?php

namespace Ctc\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CtcUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
