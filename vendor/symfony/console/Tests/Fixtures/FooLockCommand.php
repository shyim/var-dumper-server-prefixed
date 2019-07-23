<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\LockableTrait;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class FooLockCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    use LockableTrait;
    protected function configure()
    {
        $this->setName('foo:lock');
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        if (!$this->lock()) {
            return 1;
        }
        $this->release();
        return 2;
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooLockCommand', 'FooLockCommand', \false);
