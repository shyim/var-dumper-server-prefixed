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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ServiceLocator;
class ContainerCommandLoaderTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testHas()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ServiceLocator(['foo-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]), ['foo' => 'foo-service', 'bar' => 'bar-service']);
        $this->assertTrue($loader->has('foo'));
        $this->assertTrue($loader->has('bar'));
        $this->assertFalse($loader->has('baz'));
    }
    public function testGet()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ServiceLocator(['foo-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]), ['foo' => 'foo-service', 'bar' => 'bar-service']);
        $this->assertInstanceOf(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command::class, $loader->get('foo'));
        $this->assertInstanceOf(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command::class, $loader->get('bar'));
    }
    /**
     * @expectedException \Symfony\Component\Console\Exception\CommandNotFoundException
     */
    public function testGetUnknownCommandThrows()
    {
        (new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ServiceLocator([]), []))->get('unknown');
    }
    public function testGetCommandNames()
    {
        $loader = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ServiceLocator(['foo-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('foo');
        }, 'bar-service' => function () {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command('bar');
        }]), ['foo' => 'foo-service', 'bar' => 'bar-service']);
        $this->assertSame(['foo', 'bar'], $loader->getNames());
    }
}
