<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
//Ensure that questions have the expected outputs
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $stream = \fopen('php://memory', 'r+', \false);
    \fwrite($stream, "Foo\nBar\nBaz");
    \rewind($stream);
    $input->setStream($stream);
    $output->ask('What\'s your name?');
    $output->ask('How are you?');
    $output->ask('Where do you come from?');
};
