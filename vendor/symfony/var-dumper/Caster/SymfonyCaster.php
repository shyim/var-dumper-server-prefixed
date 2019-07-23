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

use _PhpScoper5d36eb080763e\Symfony\Component\HttpFoundation\Request;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub;
class SymfonyCaster
{
    private static $requestGetters = ['pathInfo' => 'getPathInfo', 'requestUri' => 'getRequestUri', 'baseUrl' => 'getBaseUrl', 'basePath' => 'getBasePath', 'method' => 'getMethod', 'format' => 'getRequestFormat'];
    public static function castRequest(\_PhpScoper5d36eb080763e\Symfony\Component\HttpFoundation\Request $request, array $a, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        $clone = null;
        foreach (self::$requestGetters as $prop => $getter) {
            if (null === $a[\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_PROTECTED . $prop]) {
                if (null === $clone) {
                    $clone = clone $request;
                }
                $a[\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . $prop] = $clone->{$getter}();
            }
        }
        return $a;
    }
}
