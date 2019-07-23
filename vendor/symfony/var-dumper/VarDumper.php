<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper;

use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\HtmlDumper;
// Load the global dump() function
require_once __DIR__ . '/Resources/functions/dump.php';
/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class VarDumper
{
    private static $handler;
    public static function dump($var)
    {
        if (null === self::$handler) {
            $cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
            if (isset($_SERVER['VAR_DUMPER_FORMAT'])) {
                $dumper = 'html' === $_SERVER['VAR_DUMPER_FORMAT'] ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\HtmlDumper() : new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper();
            } else {
                $dumper = \in_array(\PHP_SAPI, ['cli', 'phpdbg']) ? new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper() : new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\HtmlDumper();
            }
            self::$handler = function ($var) use($cloner, $dumper) {
                $dumper->dump($cloner->cloneVar($var));
            };
        }
        return (self::$handler)($var);
    }
    public static function setHandler(callable $callable = null)
    {
        $prevHandler = self::$handler;
        self::$handler = $callable;
        return $prevHandler;
    }
}
