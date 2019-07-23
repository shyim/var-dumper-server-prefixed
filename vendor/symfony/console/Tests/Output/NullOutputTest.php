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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class NullOutputTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testConstructor()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        \ob_start();
        $output->write('foo');
        $buffer = \ob_get_clean();
        $this->assertSame('', $buffer, '->write() does nothing (at least nothing is printed)');
        $this->assertFalse($output->isDecorated(), '->isDecorated() returns false');
    }
    public function testVerbosity()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $this->assertSame(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, $output->getVerbosity(), '->getVerbosity() returns VERBOSITY_QUIET for NullOutput by default');
        $output->setVerbosity(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE);
        $this->assertSame(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, $output->getVerbosity(), '->getVerbosity() always returns VERBOSITY_QUIET for NullOutput');
    }
    public function testSetFormatter()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $outputFormatter = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter();
        $output->setFormatter($outputFormatter);
        $this->assertNotSame($outputFormatter, $output->getFormatter());
    }
    public function testSetVerbosity()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $output->setVerbosity(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_NORMAL);
        $this->assertEquals(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_QUIET, $output->getVerbosity());
    }
    public function testSetDecorated()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $output->setDecorated(\true);
        $this->assertFalse($output->isDecorated());
    }
    public function testIsQuiet()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $this->assertTrue($output->isQuiet());
    }
    public function testIsVerbose()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $this->assertFalse($output->isVerbose());
    }
    public function testIsVeryVerbose()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $this->assertFalse($output->isVeryVerbose());
    }
    public function testIsDebug()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\NullOutput();
        $this->assertFalse($output->isDebug());
    }
}
