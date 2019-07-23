<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster;

use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts Redis class from ext-redis to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class RedisCaster
{
    private static $serializer = [\_PhpScoper5d36eb080763e\Redis::SERIALIZER_NONE => 'NONE', \_PhpScoper5d36eb080763e\Redis::SERIALIZER_PHP => 'PHP', 2 => 'IGBINARY'];
    private static $mode = [\_PhpScoper5d36eb080763e\Redis::ATOMIC => 'ATOMIC', \_PhpScoper5d36eb080763e\Redis::MULTI => 'MULTI', \_PhpScoper5d36eb080763e\Redis::PIPELINE => 'PIPELINE'];
    private static $compression = [
        0 => 'NONE',
        // Redis::COMPRESSION_NONE
        1 => 'LZF',
    ];
    private static $failover = [\_PhpScoper5d36eb080763e\RedisCluster::FAILOVER_NONE => 'NONE', \_PhpScoper5d36eb080763e\RedisCluster::FAILOVER_ERROR => 'ERROR', \_PhpScoper5d36eb080763e\RedisCluster::FAILOVER_DISTRIBUTE => 'DISTRIBUTE', \_PhpScoper5d36eb080763e\RedisCluster::FAILOVER_DISTRIBUTE_SLAVES => 'DISTRIBUTE_SLAVES'];
    public static function castRedis(\_PhpScoper5d36eb080763e\Redis $c, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $prefix = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        if (!($connected = $c->isConnected())) {
            return $a + [$prefix . 'isConnected' => $connected];
        }
        $mode = $c->getMode();
        return $a + [$prefix . 'isConnected' => $connected, $prefix . 'host' => $c->getHost(), $prefix . 'port' => $c->getPort(), $prefix . 'auth' => $c->getAuth(), $prefix . 'mode' => isset(self::$mode[$mode]) ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$mode[$mode], $mode) : $mode, $prefix . 'dbNum' => $c->getDbNum(), $prefix . 'timeout' => $c->getTimeout(), $prefix . 'lastError' => $c->getLastError(), $prefix . 'persistentId' => $c->getPersistentID(), $prefix . 'options' => self::getRedisOptions($c)];
    }
    public static function castRedisArray(\_PhpScoper5d36eb080763e\RedisArray $c, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $prefix = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        return $a + [$prefix . 'hosts' => $c->_hosts(), $prefix . 'function' => \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ClassStub::wrapCallable($c->_function()), $prefix . 'lastError' => $c->getLastError(), $prefix . 'options' => self::getRedisOptions($c)];
    }
    public static function castRedisCluster(\_PhpScoper5d36eb080763e\RedisCluster $c, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $prefix = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        $failover = $c->getOption(\_PhpScoper5d36eb080763e\RedisCluster::OPT_SLAVE_FAILOVER);
        $a += [$prefix . '_masters' => $c->_masters(), $prefix . '_redir' => $c->_redir(), $prefix . 'mode' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub($c->getMode() ? 'MULTI' : 'ATOMIC', $c->getMode()), $prefix . 'lastError' => $c->getLastError(), $prefix . 'options' => self::getRedisOptions($c, ['SLAVE_FAILOVER' => isset(self::$failover[$failover]) ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$failover[$failover], $failover) : $failover])];
        return $a;
    }
    /**
     * @param \Redis|\RedisArray|\RedisCluster $redis
     */
    private static function getRedisOptions($redis, array $options = []) : \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\EnumStub
    {
        $serializer = $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_SERIALIZER);
        if (\is_array($serializer)) {
            foreach ($serializer as &$v) {
                if (isset(self::$serializer[$v])) {
                    $v = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$serializer[$v], $v);
                }
            }
        } elseif (isset(self::$serializer[$serializer])) {
            $serializer = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$serializer[$serializer], $serializer);
        }
        $compression = \defined('Redis::OPT_COMPRESSION') ? $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_COMPRESSION) : 0;
        if (\is_array($compression)) {
            foreach ($compression as &$v) {
                if (isset(self::$compression[$v])) {
                    $v = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$compression[$v], $v);
                }
            }
        } elseif (isset(self::$compression[$compression])) {
            $compression = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub(self::$compression[$compression], $compression);
        }
        $retry = \defined('Redis::OPT_SCAN') ? $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_SCAN) : 0;
        if (\is_array($retry)) {
            foreach ($retry as &$v) {
                $v = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub($v ? 'RETRY' : 'NORETRY', $v);
            }
        } else {
            $retry = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ConstStub($retry ? 'RETRY' : 'NORETRY', $retry);
        }
        $options += ['TCP_KEEPALIVE' => \defined('Redis::OPT_TCP_KEEPALIVE') ? $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_TCP_KEEPALIVE) : 0, 'READ_TIMEOUT' => $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_READ_TIMEOUT), 'COMPRESSION' => $compression, 'SERIALIZER' => $serializer, 'PREFIX' => $redis->getOption(\_PhpScoper5d36eb080763e\Redis::OPT_PREFIX), 'SCAN' => $retry];
        return new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\EnumStub($options);
    }
}
