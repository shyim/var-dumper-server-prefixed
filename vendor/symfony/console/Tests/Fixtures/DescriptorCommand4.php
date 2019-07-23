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
class DescriptorCommand4 extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('descriptor:command4')->setAliases(['descriptor:alias_command4', 'command4:descriptor']);
    }
}
