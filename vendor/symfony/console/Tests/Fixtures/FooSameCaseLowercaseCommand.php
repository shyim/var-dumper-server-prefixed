<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
class FooSameCaseLowercaseCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('foo:bar')->setDescription('foo:bar command');
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooSameCaseLowercaseCommand', 'FooSameCaseLowercaseCommand', \false);
