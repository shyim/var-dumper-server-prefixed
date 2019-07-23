<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\CommandLoader;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\FactoryCommandLoader;
class FactoryCommandLoaderTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testHas()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\FactoryCommandLoader(['foo' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]);
        $this->assertTrue($loader->has('foo'));
        $this->assertTrue($loader->has('bar'));
        $this->assertFalse($loader->has('baz'));
    }
    public function testGet()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\FactoryCommandLoader(['foo' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]);
        $this->assertInstanceOf(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command::class, $loader->get('foo'));
        $this->assertInstanceOf(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command::class, $loader->get('bar'));
    }
    /**
     * @expectedException \Symfony\Component\Console\Exception\CommandNotFoundException
     */
    public function testGetUnknownCommandThrows()
    {
        (new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\FactoryCommandLoader([]))->get('unknown');
    }
    public function testGetCommandNames()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\FactoryCommandLoader(['foo' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]);
        $this->assertSame(['foo', 'bar'], $loader->getNames());
    }
}
