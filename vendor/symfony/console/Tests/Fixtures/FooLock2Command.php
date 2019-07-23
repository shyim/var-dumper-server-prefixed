<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\LockableTrait;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class FooLock2Command extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    use LockableTrait;
    protected function configure()
    {
        $this->setName('foo:lock2');
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        try {
            $this->lock();
            $this->lock();
        } catch (\LogicException $e) {
            return 1;
        }
        return 2;
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooLock2Command', 'FooLock2Command', \false);
