<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class Foo1Command extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    public $input;
    public $output;
    protected function configure()
    {
        $this->setName('foo:bar1')->setDescription('The foo:bar1 command')->setAliases(['afoobar1']);
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}
\class_alias('_PhpScoper5d36eb080763e\\Foo1Command', 'Foo1Command', \false);
