<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Tester;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Application;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\QuestionHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\ApplicationTester;
class ApplicationTesterTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    protected $application;
    protected $tester;
    protected function setUp()
    {
        $this->application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application();
        $this->application->setAutoExit(\false);
        $this->application->register('foo')->addArgument('foo')->setCode(function ($input, $output) {
            $output->writeln('foo');
        });
        $this->tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\ApplicationTester($this->application);
        $this->tester->run(['command' => 'foo', 'foo' => 'bar'], ['interactive' => \false, 'decorated' => \false, 'verbosity' => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_VERBOSE]);
    }
    protected function tearDown()
    {
        $this->application = null;
        $this->tester = null;
    }
    public function testRun()
    {
        $this->assertFalse($this->tester->getInput()->isInteractive(), '->execute() takes an interactive option');
        $this->assertFalse($this->tester->getOutput()->isDecorated(), '->execute() takes a decorated option');
        $this->assertEquals(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_VERBOSE, $this->tester->getOutput()->getVerbosity(), '->execute() takes a verbosity option');
    }
    public function testGetInput()
    {
        $this->assertEquals('bar', $this->tester->getInput()->getArgument('foo'), '->getInput() returns the current input instance');
    }
    public function testGetOutput()
    {
        \rewind($this->tester->getOutput()->getStream());
        $this->assertEquals('foo' . \PHP_EOL, \stream_get_contents($this->tester->getOutput()->getStream()), '->getOutput() returns the current output instance');
    }
    public function testGetDisplay()
    {
        $this->assertEquals('foo' . \PHP_EOL, $this->tester->getDisplay(), '->getDisplay() returns the display of the last execution');
    }
    public function testSetInputs()
    {
        $application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application();
        $application->setAutoExit(\false);
        $application->register('foo')->setCode(function ($input, $output) {
            $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\QuestionHelper();
            $helper->ask($input, $output, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Q1'));
            $helper->ask($input, $output, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Q2'));
            $helper->ask($input, $output, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Q3'));
        });
        $tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\ApplicationTester($application);
        $tester->setInputs(['I1', 'I2', 'I3']);
        $tester->run(['command' => 'foo']);
        $this->assertSame(0, $tester->getStatusCode());
        $this->assertEquals('Q1Q2Q3', $tester->getDisplay(\true));
    }
    public function testGetStatusCode()
    {
        $this->assertSame(0, $this->tester->getStatusCode(), '->getStatusCode() returns the status code');
    }
    public function testErrorOutput()
    {
        $application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application();
        $application->setAutoExit(\false);
        $application->register('foo')->addArgument('foo')->setCode(function ($input, $output) {
            $output->getErrorOutput()->write('foo');
        });
        $tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\ApplicationTester($application);
        $tester->run(['command' => 'foo', 'foo' => 'bar'], ['capture_stderr_separately' => \true]);
        $this->assertSame('foo', $tester->getErrorOutput());
    }
}
