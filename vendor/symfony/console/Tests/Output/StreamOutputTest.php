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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput;
class StreamOutputTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    protected $stream;
    protected function setUp()
    {
        $this->stream = \fopen('php://memory', 'a', \false);
    }
    protected function tearDown()
    {
        $this->stream = null;
    }
    public function testConstructor()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_QUIET, \true);
        $this->assertEquals(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\Output::VERBOSITY_QUIET, $output->getVerbosity(), '__construct() takes the verbosity as its first argument');
        $this->assertTrue($output->isDecorated(), '__construct() takes the decorated flag as its second argument');
    }
    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The StreamOutput class needs a stream as its first argument.
     */
    public function testStreamIsRequired()
    {
        new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput('foo');
    }
    public function testGetStream()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream);
        $this->assertEquals($this->stream, $output->getStream(), '->getStream() returns the current stream');
    }
    public function testDoWrite()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput($this->stream);
        $output->writeln('foo');
        \rewind($output->getStream());
        $this->assertEquals('foo' . \PHP_EOL, \stream_get_contents($output->getStream()), '->doWrite() writes to the stream');
    }
}
