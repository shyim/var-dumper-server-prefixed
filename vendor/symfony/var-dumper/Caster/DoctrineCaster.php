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

use _PhpScoper5d36eb080763e\Doctrine\Common\Proxy\Proxy as CommonProxy;
use _PhpScoper5d36eb080763e\Doctrine\ORM\PersistentCollection;
use _PhpScoper5d36eb080763e\Doctrine\ORM\Proxy\Proxy as OrmProxy;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts Doctrine related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class DoctrineCaster
{
    public static function castCommonProxy(\_PhpScoper5d36eb080763e\Doctrine\Common\Proxy\Proxy $proxy, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        foreach (['__cloner__', '__initializer__'] as $k) {
            if (\array_key_exists($k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }
        return $a;
    }
    public static function castOrmProxy(\_PhpScoper5d36eb080763e\Doctrine\ORM\Proxy\Proxy $proxy, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        foreach (['_entityPersister', '_identifier'] as $k) {
            if (\array_key_exists($k = "\0Doctrine\\ORM\\Proxy\\Proxy\0" . $k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }
        return $a;
    }
    public static function castPersistentCollection(\_PhpScoper5d36eb080763e\Doctrine\ORM\PersistentCollection $coll, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        foreach (['snapshot', 'association', 'typeClass'] as $k) {
            if (\array_key_exists($k = "\0Doctrine\\ORM\\PersistentCollection\0" . $k, $a)) {
                $a[$k] = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\CutStub($a[$k]);
            }
        }
        return $a;
    }
}
