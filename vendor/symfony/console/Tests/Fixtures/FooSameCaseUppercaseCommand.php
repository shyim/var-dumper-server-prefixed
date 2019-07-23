<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
class FooSameCaseUppercaseCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('foo:BAR')->setDescription('foo:BAR command');
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooSameCaseUppercaseCommand', 'FooSameCaseUppercaseCommand', \false);
