<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\EventListener;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Psr\Log\LoggerInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Event\ConsoleErrorEvent;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Event\ConsoleTerminateEvent;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArgvInput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArrayInput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\Input;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StringInput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
class ErrorListenerTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testOnConsoleError()
    {
        $error = new \TypeError('An error occurred');
        $logger = $this->getLogger();
        $logger->expects($this->once())->method('error')->with('Error thrown while running command "{command}". Message: "{message}"', ['exception' => $error, 'command' => 'test:run --foo=baz buzz', 'message' => 'An error occurred']);
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleError(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Event\ConsoleErrorEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArgvInput(['console.php', 'test:run', '--foo=baz', 'buzz']), $this->getOutput(), $error, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('test:run')));
    }
    public function testOnConsoleErrorWithNoCommandAndNoInputString()
    {
        $error = new \RuntimeException('An error occurred');
        $logger = $this->getLogger();
        $logger->expects($this->once())->method('error')->with('An error occurred while using the console. Message: "{message}"', ['exception' => $error, 'message' => 'An error occurred']);
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleError(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Event\ConsoleErrorEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\EventListener\NonStringInput(), $this->getOutput(), $error));
    }
    public function testOnConsoleTerminateForNonZeroExitCodeWritesToLog()
    {
        $logger = $this->getLogger();
        $logger->expects($this->once())->method('debug')->with('Command "{command}" exited with code "{code}"', ['command' => 'test:run', 'code' => 255]);
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArgvInput(['console.php', 'test:run']), 255));
    }
    public function testOnConsoleTerminateForZeroExitCodeDoesNotWriteToLog()
    {
        $logger = $this->getLogger();
        $logger->expects($this->never())->method('debug');
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArgvInput(['console.php', 'test:run']), 0));
    }
    public function testGetSubscribedEvents()
    {
        $this->assertEquals(['console.error' => ['onConsoleError', -128], 'console.terminate' => ['onConsoleTerminate', -128]], \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener::getSubscribedEvents());
    }
    public function testAllKindsOfInputCanBeLogged()
    {
        $logger = $this->getLogger();
        $logger->expects($this->exactly(3))->method('debug')->with('Command "{command}" exited with code "{code}"', ['command' => 'test:run --foo=bar', 'code' => 255]);
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArgvInput(['console.php', 'test:run', '--foo=bar']), 255));
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\ArrayInput(['name' => 'test:run', '--foo' => 'bar']), 255));
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StringInput('test:run --foo=bar'), 255));
    }
    public function testCommandNameIsDisplayedForNonStringableInput()
    {
        $logger = $this->getLogger();
        $logger->expects($this->once())->method('debug')->with('Command "{command}" exited with code "{code}"', ['command' => 'test:run', 'code' => 255]);
        $listener = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\EventListener\ErrorListener($logger);
        $listener->onConsoleTerminate($this->getConsoleTerminateEvent($this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface::class)->getMock(), 255));
    }
    private function getLogger()
    {
        return $this->getMockForAbstractClass(\_PhpScoper5d36eb080763e\Psr\Log\LoggerInterface::class);
    }
    private function getConsoleTerminateEvent(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface $input, $exitCode)
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Event\ConsoleTerminateEvent(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('test:run'), $input, $this->getOutput(), $exitCode);
    }
    private function getOutput()
    {
        return $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::class)->getMock();
    }
}
class NonStringInput extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\Input
{
    public function getFirstArgument()
    {
    }
    public function hasParameterOption($values, $onlyParams = \false)
    {
    }
    public function getParameterOption($values, $default = \false, $onlyParams = \false)
    {
    }
    public function parse()
    {
    }
}
