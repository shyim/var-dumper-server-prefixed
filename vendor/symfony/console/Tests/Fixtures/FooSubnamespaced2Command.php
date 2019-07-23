<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class FooSubnamespaced2Command extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    public $input;
    public $output;
    protected function configure()
    {
        $this->setName('foo:go:bret')->setDescription('The foo:bar:go command')->setAliases(['foobargo']);
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooSubnamespaced2Command', 'FooSubnamespaced2Command', \false);
