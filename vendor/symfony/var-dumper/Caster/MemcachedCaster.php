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
 * @author Jan Schädlich <jan.schaedlich@sensiolabs.de>
 */
class MemcachedCaster
{
    private static $optionConstants;
    private static $defaultOptions;
    public static function castMemcached(\_PhpScoper5d36eb080763e\Memcached $c, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $a += [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'servers' => $c->getServerList(), \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'options' => new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\EnumStub(self::getNonDefaultOptions($c))];
        return $a;
    }
    private static function getNonDefaultOptions(\_PhpScoper5d36eb080763e\Memcached $c)
    {
        self::$defaultOptions = self::$defaultOptions ?? self::discoverDefaultOptions();
        self::$optionConstants = self::$optionConstants ?? self::getOptionConstants();
        $nonDefaultOptions = [];
        foreach (self::$optionConstants as $constantKey => $value) {
            if (self::$defaultOptions[$constantKey] !== ($option = $c->getOption($value))) {
                $nonDefaultOptions[$constantKey] = $option;
            }
        }
        return $nonDefaultOptions;
    }
    private static function discoverDefaultOptions()
    {
        $defaultMemcached = new \_PhpScoper5d36eb080763e\Memcached();
        $defaultMemcached->addServer('127.0.0.1', 11211);
        $defaultOptions = [];
        self::$optionConstants = self::$optionConstants ?? self::getOptionConstants();
        foreach (self::$optionConstants as $constantKey => $value) {
            $defaultOptions[$constantKey] = $defaultMemcached->getOption($value);
        }
        return $defaultOptions;
    }
    private static function getOptionConstants()
    {
        $reflectedMemcached = new \ReflectionClass(\_PhpScoper5d36eb080763e\Memcached::class);
        $optionConstants = [];
        foreach ($reflectedMemcached->getConstants() as $constantKey => $value) {
            if (0 === \strpos($constantKey, 'OPT_')) {
                $optionConstants[$constantKey] = $value;
            }
        }
        return $optionConstants;
    }
}
