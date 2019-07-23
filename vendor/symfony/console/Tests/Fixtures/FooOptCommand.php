<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputOption;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class FooOptCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    public $input;
    public $output;
    protected function configure()
    {
        $this->setName('foo:bar')->setDescription('The foo:bar command')->setAliases(['afoobar'])->addOption('fooopt', 'fo', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, 'fooopt description');
    }
    protected function interact(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $output->writeln('interact called');
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $output->writeln('called');
        $output->writeln($this->input->getOption('fooopt'));
    }
}
\class_alias('_PhpScoper5d36eb080763e\\FooOptCommand', 'FooOptCommand', \false);
