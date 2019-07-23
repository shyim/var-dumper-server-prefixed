<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputArgument;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputOption;
class DescriptorCommandMbString extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('descriptor:åèä')->setDescription('command åèä description')->setHelp('command åèä help')->addUsage('-o|--option_name <argument_name>')->addUsage('<argument_name>')->addArgument('argument_åèä', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputArgument::REQUIRED)->addOption('option_åèä', 'o', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputOption::VALUE_NONE);
    }
}
