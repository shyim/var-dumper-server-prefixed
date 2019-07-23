<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Cache;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface;
use _PhpScoper5d36eb080763e\Psr\Cache\CacheItemPoolInterface;
use _PhpScoper5d36eb080763e\Symfony\Contracts\Cache\CacheTrait;
/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CacheTraitTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testSave()
    {
        $item = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface::class)->getMock();
        $item->method('set')->willReturn($item);
        $item->method('isHit')->willReturn(\false);
        $item->expects($this->once())->method('set')->with('computed data');
        $cache = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Cache\TestPool::class)->setMethods(['getItem', 'save'])->getMock();
        $cache->expects($this->once())->method('getItem')->with('key')->willReturn($item);
        $cache->expects($this->once())->method('save');
        $callback = function (\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item) {
            return 'computed data';
        };
        $cache->get('key', $callback);
    }
    public function testNoCallbackCallOnHit()
    {
        $item = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface::class)->getMock();
        $item->method('isHit')->willReturn(\true);
        $item->expects($this->never())->method('set');
        $cache = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Cache\TestPool::class)->setMethods(['getItem', 'save'])->getMock();
        $cache->expects($this->once())->method('getItem')->with('key')->willReturn($item);
        $cache->expects($this->never())->method('save');
        $callback = function (\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item) {
            $this->assertTrue(\false, 'This code should never be reached');
        };
        $cache->get('key', $callback);
    }
    public function testRecomputeOnBetaInf()
    {
        $item = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface::class)->getMock();
        $item->method('set')->willReturn($item);
        $item->method('isHit')->willReturn(\true);
        $item->expects($this->once())->method('set')->with('computed data');
        $cache = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Cache\TestPool::class)->setMethods(['getItem', 'save'])->getMock();
        $cache->expects($this->once())->method('getItem')->with('key')->willReturn($item);
        $cache->expects($this->once())->method('save');
        $callback = function (\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item) {
            return 'computed data';
        };
        $cache->get('key', $callback, \INF);
    }
    public function testExceptionOnNegativeBeta()
    {
        $cache = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Cache\TestPool::class)->setMethods(['getItem', 'save'])->getMock();
        $callback = function (\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item) {
            return 'computed data';
        };
        $this->expectException(\InvalidArgumentException::class);
        $cache->get('key', $callback, -2);
    }
}
class TestPool implements \_PhpScoper5d36eb080763e\Psr\Cache\CacheItemPoolInterface
{
    use CacheTrait;
    public function hasItem($key)
    {
    }
    public function deleteItem($key)
    {
    }
    public function deleteItems(array $keys = [])
    {
    }
    public function getItem($key)
    {
    }
    public function getItems(array $key = [])
    {
    }
    public function saveDeferred(\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item)
    {
    }
    public function save(\_PhpScoper5d36eb080763e\Psr\Cache\CacheItemInterface $item)
    {
    }
    public function commit()
    {
    }
    public function clear()
    {
    }
}
