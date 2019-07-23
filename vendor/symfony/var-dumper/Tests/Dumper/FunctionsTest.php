<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Dumper;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper;
class FunctionsTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testDumpReturnsFirstArg()
    {
        $this->setupVarDumper();
        $var1 = 'a';
        \ob_start();
        $return = dump($var1);
        $out = \ob_get_clean();
        $this->assertEquals($var1, $return);
    }
    public function testDumpReturnsAllArgsInArray()
    {
        $this->setupVarDumper();
        $var1 = 'a';
        $var2 = 'b';
        $var3 = 'c';
        \ob_start();
        $return = dump($var1, $var2, $var3);
        $out = \ob_get_clean();
        $this->assertEquals([$var1, $var2, $var3], $return);
    }
    protected function setupVarDumper()
    {
        $cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
        $dumper = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper('php://output');
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper::setHandler(function ($var) use($cloner, $dumper) {
            $dumper->dump($cloner->cloneVar($var));
        });
    }
}
