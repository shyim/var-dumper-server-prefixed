<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Test;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Test\VarDumperTestTrait;
class VarDumperTestTraitTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    use VarDumperTestTrait;
    public function testItComparesLargeData()
    {
        $howMany = 700;
        $data = \array_fill_keys(\range(0, $howMany), ['a', 'b', 'c', 'd']);
        $expected = \sprintf("array:%d [\n", $howMany + 1);
        for ($i = 0; $i <= $howMany; ++$i) {
            $expected .= <<<EODUMP
  {$i} => array:4 [
    0 => "a"
    1 => "b"
    2 => "c"
    3 => "d"
  ]

EODUMP;
        }
        $expected .= "]\n";
        $this->assertDumpEquals($expected, $data);
    }
    public function testAllowsNonScalarExpectation()
    {
        $this->assertDumpEquals(new \ArrayObject(['bim' => 'bam']), new \ArrayObject(['bim' => 'bam']));
    }
}
