<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Formatter;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack;
class OutputFormatterStyleStackTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testPush()
    {
        $stack = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack();
        $stack->push($s1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('white', 'black'));
        $stack->push($s2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('yellow', 'blue'));
        $this->assertEquals($s2, $stack->getCurrent());
        $stack->push($s3 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('green', 'red'));
        $this->assertEquals($s3, $stack->getCurrent());
    }
    public function testPop()
    {
        $stack = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack();
        $stack->push($s1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('white', 'black'));
        $stack->push($s2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('yellow', 'blue'));
        $this->assertEquals($s2, $stack->pop());
        $this->assertEquals($s1, $stack->pop());
    }
    public function testPopEmpty()
    {
        $stack = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack();
        $style = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle();
        $this->assertEquals($style, $stack->pop());
    }
    public function testPopNotLast()
    {
        $stack = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack();
        $stack->push($s1 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('white', 'black'));
        $stack->push($s2 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('yellow', 'blue'));
        $stack->push($s3 = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('green', 'red'));
        $this->assertEquals($s2, $stack->pop($s2));
        $this->assertEquals($s1, $stack->pop());
    }
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidPop()
    {
        $stack = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyleStack();
        $stack->push(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('white', 'black'));
        $stack->pop(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Formatter\OutputFormatterStyle('yellow', 'blue'));
    }
}
