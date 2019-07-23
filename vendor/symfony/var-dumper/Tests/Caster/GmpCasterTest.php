<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Caster;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\GmpCaster;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Test\VarDumperTestTrait;
class GmpCasterTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    use VarDumperTestTrait;
    /**
     * @requires extension gmp
     */
    public function testCastGmp()
    {
        $gmpString = \gmp_init('1234');
        $gmpOctal = \gmp_init(010);
        $gmp = \gmp_init('01101');
        $gmpDump = <<<EODUMP
array:1 [
  "\\x00~\\x00value" => %s
]
EODUMP;
        $this->assertDumpEquals(\sprintf($gmpDump, $gmpString), \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\GmpCaster::castGmp($gmpString, [], new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub(), \false, 0));
        $this->assertDumpEquals(\sprintf($gmpDump, $gmpOctal), \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\GmpCaster::castGmp($gmpOctal, [], new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub(), \false, 0));
        $this->assertDumpEquals(\sprintf($gmpDump, $gmp), \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\GmpCaster::castGmp($gmp, [], new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub(), \false, 0));
        $dump = <<<EODUMP
GMP {
  value: 577
}
EODUMP;
        $this->assertDumpEquals($dump, $gmp);
    }
}
