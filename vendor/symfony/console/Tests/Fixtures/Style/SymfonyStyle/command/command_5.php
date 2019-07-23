<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
//Ensure has proper line ending before outputting a text block like with SymfonyStyle::listing() or SymfonyStyle::text()
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $output->writeln('Lorem ipsum dolor sit amet');
    $output->listing(['Lorem ipsum dolor sit amet', 'consectetur adipiscing elit']);
    //Even using write:
    $output->write('Lorem ipsum dolor sit amet');
    $output->listing(['Lorem ipsum dolor sit amet', 'consectetur adipiscing elit']);
    $output->write('Lorem ipsum dolor sit amet');
    $output->text(['Lorem ipsum dolor sit amet', 'consectetur adipiscing elit']);
    $output->newLine();
    $output->write('Lorem ipsum dolor sit amet');
    $output->comment(['Lorem ipsum dolor sit amet', 'consectetur adipiscing elit']);
};
