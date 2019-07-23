<?php

namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Helper;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput;
/**
 * @group time-sensitive
 */
class ProgressIndicatorTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testDefaultIndicator()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($output = $this->getOutputStream());
        $bar->start('Starting...');
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->setMessage('Advancing...');
        $bar->advance();
        $bar->finish('Done...');
        $bar->start('Starting Again...');
        \usleep(101000);
        $bar->advance();
        $bar->finish('Done Again...');
        \rewind($output->getStream());
        $this->assertEquals($this->generateOutput(' - Starting...') . $this->generateOutput(' \\ Starting...') . $this->generateOutput(' | Starting...') . $this->generateOutput(' / Starting...') . $this->generateOutput(' - Starting...') . $this->generateOutput(' \\ Starting...') . $this->generateOutput(' \\ Advancing...') . $this->generateOutput(' | Advancing...') . $this->generateOutput(' | Done...') . \PHP_EOL . $this->generateOutput(' - Starting Again...') . $this->generateOutput(' \\ Starting Again...') . $this->generateOutput(' \\ Done Again...') . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testNonDecoratedOutput()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($output = $this->getOutputStream(\false));
        $bar->start('Starting...');
        $bar->advance();
        $bar->advance();
        $bar->setMessage('Midway...');
        $bar->advance();
        $bar->advance();
        $bar->finish('Done...');
        \rewind($output->getStream());
        $this->assertEquals(' Starting...' . \PHP_EOL . ' Midway...' . \PHP_EOL . ' Done...' . \PHP_EOL . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testCustomIndicatorValues()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($output = $this->getOutputStream(), null, 100, ['a', 'b', 'c']);
        $bar->start('Starting...');
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \usleep(101000);
        $bar->advance();
        \rewind($output->getStream());
        $this->assertEquals($this->generateOutput(' a Starting...') . $this->generateOutput(' b Starting...') . $this->generateOutput(' c Starting...') . $this->generateOutput(' a Starting...'), \stream_get_contents($output->getStream()));
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Must have at least 2 indicator value characters.
     */
    public function testCannotSetInvalidIndicatorCharacters()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($this->getOutputStream(), null, 100, ['1']);
    }
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Progress indicator already started.
     */
    public function testCannotStartAlreadyStartedIndicator()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($this->getOutputStream());
        $bar->start('Starting...');
        $bar->start('Starting Again.');
    }
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Progress indicator has not yet been started.
     */
    public function testCannotAdvanceUnstartedIndicator()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($this->getOutputStream());
        $bar->advance();
    }
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Progress indicator has not yet been started.
     */
    public function testCannotFinishUnstartedIndicator()
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($this->getOutputStream());
        $bar->finish('Finished');
    }
    /**
     * @dataProvider provideFormat
     */
    public function testFormats($format)
    {
        $bar = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProgressIndicator($output = $this->getOutputStream(), $format);
        $bar->start('Starting...');
        $bar->advance();
        \rewind($output->getStream());
        $this->assertNotEmpty(\stream_get_contents($output->getStream()));
    }
    /**
     * Provides each defined format.
     *
     * @return array
     */
    public function provideFormat()
    {
        return [['normal'], ['verbose'], ['very_verbose'], ['debug']];
    }
    protected function getOutputStream($decorated = \true, $verbosity = \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_NORMAL)
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput(\fopen('php://memory', 'r+', \false), $verbosity, $decorated);
    }
    protected function generateOutput($expected)
    {
        $count = \substr_count($expected, "\n");
        return "\r\33[2K" . ($count ? \sprintf("\33[%dA", $count) : '') . $expected;
    }
}
