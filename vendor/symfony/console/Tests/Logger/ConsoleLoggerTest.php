<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Logger;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Psr\Log\LoggerInterface;
use _PhpScoper5d36eb080763e\Psr\Log\LogLevel;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Logger\ConsoleLogger;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\BufferedOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DummyOutput;
/**
 * Console logger test.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class ConsoleLoggerTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    /**
     * @var DummyOutput
     */
    protected $output;
    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        $this->output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DummyOutput(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE);
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Logger\ConsoleLogger($this->output, [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ALERT => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::CRITICAL => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ERROR => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::WARNING => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::NOTICE => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL]);
    }
    /**
     * Return the log messages in order.
     *
     * @return string[]
     */
    public function getLogs()
    {
        return $this->output->getLogs();
    }
    /**
     * @dataProvider provideOutputMappingParams
     */
    public function testOutputMapping($logLevel, $outputVerbosity, $isOutput, $addVerbosityLevelMap = [])
    {
        $out = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\BufferedOutput($outputVerbosity);
        $logger = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Logger\ConsoleLogger($out, $addVerbosityLevelMap);
        $logger->log($logLevel, 'foo bar');
        $logs = $out->fetch();
        $this->assertEquals($isOutput ? "[{$logLevel}] foo bar" . \PHP_EOL : '', $logs);
    }
    public function provideOutputMappingParams()
    {
        $quietMap = [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY => \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET];
        return [[\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::WARNING, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE, \true], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_DEBUG, \true], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ALERT, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, \false], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ALERT, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, \false, $quietMap], [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_QUIET, \true, $quietMap]];
    }
    public function testHasErrored()
    {
        $logger = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Logger\ConsoleLogger(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\BufferedOutput());
        $this->assertFalse($logger->hasErrored());
        $logger->warning('foo');
        $this->assertFalse($logger->hasErrored());
        $logger->error('bar');
        $this->assertTrue($logger->hasErrored());
    }
    public function testImplements()
    {
        $this->assertInstanceOf('_PhpScoper5d36eb080763e\\Psr\\Log\\LoggerInterface', $this->getLogger());
    }
    /**
     * @dataProvider provideLevelsAndMessages
     */
    public function testLogsAtAllLevels($level, $message)
    {
        $logger = $this->getLogger();
        $logger->{$level}($message, ['user' => 'Bob']);
        $logger->log($level, $message, ['user' => 'Bob']);
        $expected = [$level . ' message of level ' . $level . ' with context: Bob', $level . ' message of level ' . $level . ' with context: Bob'];
        $this->assertEquals($expected, $this->getLogs());
    }
    public function provideLevelsAndMessages()
    {
        return [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::EMERGENCY, 'message of level emergency with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ALERT => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ALERT, 'message of level alert with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::CRITICAL => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::CRITICAL, 'message of level critical with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ERROR => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::ERROR, 'message of level error with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::WARNING => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::WARNING, 'message of level warning with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::NOTICE => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::NOTICE, 'message of level notice with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::INFO, 'message of level info with context: {user}'], \_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG => [\_PhpScoper5d36eb080763e\Psr\Log\LogLevel::DEBUG, 'message of level debug with context: {user}']];
    }
    /**
     * @expectedException \Psr\Log\InvalidArgumentException
     */
    public function testThrowsOnInvalidLevel()
    {
        $logger = $this->getLogger();
        $logger->log('invalid level', 'Foo');
    }
    public function testContextReplacement()
    {
        $logger = $this->getLogger();
        $logger->info('{Message {nothing} {user} {foo.bar} a}', ['user' => 'Bob', 'foo.bar' => 'Bar']);
        $expected = ['info {Message {nothing} Bob Bar a}'];
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testObjectCastToString()
    {
        if (\method_exists($this, 'createPartialMock')) {
            $dummy = $this->createPartialMock('_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\Logger\\DummyTest', ['__toString']);
        } else {
            $dummy = $this->getMock('_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\Logger\\DummyTest', ['__toString']);
        }
        $dummy->method('__toString')->will($this->returnValue('DUMMY'));
        $this->getLogger()->warning($dummy);
        $expected = ['warning DUMMY'];
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testContextCanContainAnything()
    {
        $context = ['bool' => \true, 'null' => null, 'string' => 'Foo', 'int' => 0, 'float' => 0.5, 'nested' => ['with object' => new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Logger\DummyTest()], 'object' => new \DateTime(), 'resource' => \fopen('php://memory', 'r')];
        $this->getLogger()->warning('Crazy context data', $context);
        $expected = ['warning Crazy context data'];
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testContextExceptionKeyCanBeExceptionOrOtherValues()
    {
        $logger = $this->getLogger();
        $logger->warning('Random message', ['exception' => 'oops']);
        $logger->critical('Uncaught Exception!', ['exception' => new \LogicException('Fail')]);
        $expected = ['warning Random message', 'critical Uncaught Exception!'];
        $this->assertEquals($expected, $this->getLogs());
    }
}
class DummyTest
{
    public function __toString()
    {
    }
}
