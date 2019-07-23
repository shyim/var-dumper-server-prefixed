<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class TestToto extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('test-toto')->setDescription('The test-toto command')->setAliases(['test']);
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $output->write('test-toto');
    }
}
\class_alias('_PhpScoper5d36eb080763e\\TestToto', 'TestToto', \false);
