<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Output;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output;
class ConsoleOutputTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testConstructor()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutput(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_QUIET, \true);
        $this->assertEquals(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_QUIET, $output->getVerbosity(), '__construct() takes the verbosity as its first argument');
        $this->assertSame($output->getFormatter(), $output->getErrorOutput()->getFormatter(), '__construct() takes a formatter or null as the third argument');
    }
    public function testSetFormatter()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutput();
        $outputFormatter = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter();
        $output->setFormatter($outputFormatter);
        $this->assertSame($outputFormatter, $output->getFormatter());
    }
    public function testSetVerbosity()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutput();
        $output->setVerbosity(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_VERBOSE);
        $this->assertSame(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_VERBOSE, $output->getVerbosity());
    }
}
