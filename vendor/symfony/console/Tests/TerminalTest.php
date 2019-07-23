<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Terminal;
class TerminalTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    private $colSize;
    private $lineSize;
    protected function setUp()
    {
        $this->colSize = \getenv('COLUMNS');
        $this->lineSize = \getenv('LINES');
    }
    protected function tearDown()
    {
        \putenv($this->colSize ? 'COLUMNS=' . $this->colSize : 'COLUMNS');
        \putenv($this->lineSize ? 'LINES' : 'LINES=' . $this->lineSize);
    }
    public function test()
    {
        \putenv('COLUMNS=100');
        \putenv('LINES=50');
        $terminal = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Terminal();
        $this->assertSame(100, $terminal->getWidth());
        $this->assertSame(50, $terminal->getHeight());
        \putenv('COLUMNS=120');
        \putenv('LINES=60');
        $terminal = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Terminal();
        $this->assertSame(120, $terminal->getWidth());
        $this->assertSame(60, $terminal->getHeight());
    }
    public function test_zero_values()
    {
        \putenv('COLUMNS=0');
        \putenv('LINES=0');
        $terminal = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Terminal();
        $this->assertSame(0, $terminal->getWidth());
        $this->assertSame(0, $terminal->getHeight());
    }
}
