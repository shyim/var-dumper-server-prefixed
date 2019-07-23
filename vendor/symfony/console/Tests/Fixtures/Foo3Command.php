<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class Foo3Command extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('foo3:bar')->setDescription('The foo3:bar command');
    }
    protected function execute(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output)
    {
        try {
            try {
                throw new \Exception('First exception <p>this is html</p>');
            } catch (\Exception $e) {
                throw new \Exception('Second exception <comment>comment</comment>', 0, $e);
            }
        } catch (\Exception $e) {
            throw new \Exception('Third exception <fg=blue;bg=red>comment</>', 404, $e);
        }
    }
}
\class_alias('_PhpScoper5d36eb080763e\\Foo3Command', 'Foo3Command', \false);
