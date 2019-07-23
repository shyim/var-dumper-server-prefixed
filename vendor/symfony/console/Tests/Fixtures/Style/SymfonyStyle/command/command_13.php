<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
// ensure that nested tags have no effect on the color of the '//' prefix
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $output->setDecorated(\true);
    $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $output->comment('Lorem ipsum dolor sit <comment>amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</comment> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
};
