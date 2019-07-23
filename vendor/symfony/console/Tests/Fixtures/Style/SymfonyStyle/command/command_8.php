<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\TableCell;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle;
//Ensure formatting tables when using multiple headers with TableCell
return function (\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output) {
    $headers = [[new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\TableCell('Main table title', ['colspan' => 3])], ['ISBN', 'Title', 'Author']];
    $rows = [['978-0521567817', 'De Monarchia', new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\TableCell("Dante Alighieri\nspans multiple rows", ['rowspan' => 2])], ['978-0804169127', 'Divine Comedy']];
    $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Style\SymfonyStyle($input, $output);
    $output->table($headers, $rows);
};
