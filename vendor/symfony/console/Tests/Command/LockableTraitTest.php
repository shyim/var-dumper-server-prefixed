<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Command;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester;
use _PhpScoper5d36eb080763e\Symfony\Component\Lock\Factory;
use _PhpScoper5d36eb080763e\Symfony\Component\Lock\Store\FlockStore;
use _PhpScoper5d36eb080763e\Symfony\Component\Lock\Store\SemaphoreStore;
class LockableTraitTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    protected static $fixturesPath;
    public static function setUpBeforeClass()
    {
        self::$fixturesPath = __DIR__ . '/../Fixtures/';
        require_once self::$fixturesPath . '/FooLockCommand.php';
        require_once self::$fixturesPath . '/FooLock2Command.php';
    }
    public function testLockIsReleased()
    {
        $command = new \_PhpScoper5d36eb080763e\FooLockCommand();
        $tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $this->assertSame(2, $tester->execute([]));
        $this->assertSame(2, $tester->execute([]));
    }
    public function testLockReturnsFalseIfAlreadyLockedByAnotherCommand()
    {
        $command = new \_PhpScoper5d36eb080763e\FooLockCommand();
        if (\_PhpScoper5d36eb080763e\Symfony\Component\Lock\Store\SemaphoreStore::isSupported()) {
            $store = new \_PhpScoper5d36eb080763e\Symfony\Component\Lock\Store\SemaphoreStore();
        } else {
            $store = new \_PhpScoper5d36eb080763e\Symfony\Component\Lock\Store\FlockStore();
        }
        $lock = (new \_PhpScoper5d36eb080763e\Symfony\Component\Lock\Factory($store))->createLock($command->getName());
        $lock->acquire();
        $tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $this->assertSame(1, $tester->execute([]));
        $lock->release();
        $this->assertSame(2, $tester->execute([]));
    }
    public function testMultipleLockCallsThrowLogicException()
    {
        $command = new \_PhpScoper5d36eb080763e\FooLock2Command();
        $tester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $this->assertSame(1, $tester->execute([]));
    }
}
