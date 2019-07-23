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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\QuestionHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StreamableInputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question;
class ConsoleSectionOutputTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    private $stream;
    protected function setUp()
    {
        $this->stream = \fopen('php://memory', 'r+b', \false);
    }
    protected function tearDown()
    {
        $this->stream = null;
    }
    public function testClearAll()
    {
        $sections = [];
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output->writeln('Foo' . \PHP_EOL . 'Bar');
        $output->clear();
        \rewind($output->getStream());
        $this->assertEquals('Foo' . \PHP_EOL . 'Bar' . \PHP_EOL . \sprintf("\33[%dA", 2) . "\33[0J", \stream_get_contents($output->getStream()));
    }
    public function testClearNumberOfLines()
    {
        $sections = [];
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output->writeln("Foo\nBar\nBaz\nFooBar");
        $output->clear(2);
        \rewind($output->getStream());
        $this->assertEquals("Foo\nBar\nBaz\nFooBar" . \PHP_EOL . \sprintf("\33[%dA", 2) . "\33[0J", \stream_get_contents($output->getStream()));
    }
    public function testClearNumberOfLinesWithMultipleSections()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream);
        $sections = [];
        $output1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2->writeln('Foo');
        $output2->writeln('Bar');
        $output2->clear(1);
        $output1->writeln('Baz');
        \rewind($output->getStream());
        $this->assertEquals('Foo' . \PHP_EOL . 'Bar' . \PHP_EOL . "\33[1A\33[0J\33[1A\33[0J" . 'Baz' . \PHP_EOL . 'Foo' . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testClearPreservingEmptyLines()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream);
        $sections = [];
        $output1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2->writeln(\PHP_EOL . 'foo');
        $output2->clear(1);
        $output1->writeln('bar');
        \rewind($output->getStream());
        $this->assertEquals(\PHP_EOL . 'foo' . \PHP_EOL . "\33[1A\33[0J\33[1A\33[0J" . 'bar' . \PHP_EOL . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testOverwrite()
    {
        $sections = [];
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output->writeln('Foo');
        $output->overwrite('Bar');
        \rewind($output->getStream());
        $this->assertEquals('Foo' . \PHP_EOL . "\33[1A\33[0JBar" . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testOverwriteMultipleLines()
    {
        $sections = [];
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output->writeln('Foo' . \PHP_EOL . 'Bar' . \PHP_EOL . 'Baz');
        $output->overwrite('Bar');
        \rewind($output->getStream());
        $this->assertEquals('Foo' . \PHP_EOL . 'Bar' . \PHP_EOL . 'Baz' . \PHP_EOL . \sprintf("\33[%dA", 3) . "\33[0J" . 'Bar' . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testAddingMultipleSections()
    {
        $sections = [];
        $output1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $this->assertCount(2, $sections);
    }
    public function testMultipleSectionsOutput()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream);
        $sections = [];
        $output1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($output->getStream(), $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        $output1->writeln('Foo');
        $output2->writeln('Bar');
        $output1->overwrite('Baz');
        $output2->overwrite('Foobar');
        \rewind($output->getStream());
        $this->assertEquals('Foo' . \PHP_EOL . 'Bar' . \PHP_EOL . "\33[2A\33[0JBar" . \PHP_EOL . "\33[1A\33[0JBaz" . \PHP_EOL . 'Bar' . \PHP_EOL . "\33[1A\33[0JFoobar" . \PHP_EOL, \stream_get_contents($output->getStream()));
    }
    public function testClearSectionContainingQuestion()
    {
        $inputStream = \fopen('php://memory', 'r+b', \false);
        \fwrite($inputStream, "Batman & Robin\n");
        \rewind($inputStream);
        $input = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StreamableInputInterface::class)->getMock();
        $input->expects($this->once())->method('isInteractive')->willReturn(\true);
        $input->expects($this->once())->method('getStream')->willReturn($inputStream);
        $sections = [];
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleSectionOutput($this->stream, $sections, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \true, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatter());
        (new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\QuestionHelper())->ask($input, $output, new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('What\'s your favorite super hero?'));
        $output->clear();
        \rewind($output->getStream());
        $this->assertSame('What\'s your favorite super hero?' . \PHP_EOL . "\33[2A\33[0J", \stream_get_contents($output->getStream()));
    }
}
