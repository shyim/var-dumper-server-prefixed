<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
// ensure long words are properly wrapped in blocks
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $word = 'Lopadotemachoselachogaleokranioleipsanodrimhypotrimmatosilphioparaomelitokatakechymenokichlepikossyphophattoperisteralektryonoptekephalliokigklopeleiolagoiosiraiobaphetraganopterygon';
    $sfStyle = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $sfStyle->block($word, 'CUSTOM', 'fg=white;bg=blue', ' § ', \false);
};
