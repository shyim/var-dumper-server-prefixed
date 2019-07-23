<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
//Ensure questions do not output anything when input is non-interactive
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $output->title('Title');
    $output->askHidden('Hidden question');
    $output->choice('Choice question with default', ['choice1', 'choice2'], 'choice1');
    $output->confirm('Confirmation with yes default', \true);
    $output->text('Duis aute irure dolor in reprehenderit in voluptate velit esse');
};
