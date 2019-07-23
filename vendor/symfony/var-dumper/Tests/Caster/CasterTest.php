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
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Test\VarDumperTestTrait;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CasterTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    use VarDumperTestTrait;
    private $referenceArray = ['null' => null, 'empty' => \false, 'public' => 'pub', "\0~\0virtual" => 'virt', "\0+\0dynamic" => 'dyn', "\0*\0protected" => 'prot', "\0Foo\0private" => 'priv'];
    /**
     * @dataProvider provideFilter
     */
    public function testFilter($filter, $expectedDiff, $listedProperties = null)
    {
        if (null === $listedProperties) {
            $filteredArray = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::filter($this->referenceArray, $filter);
        } else {
            $filteredArray = \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::filter($this->referenceArray, $filter, $listedProperties);
        }
        $this->assertSame($expectedDiff, \array_diff_assoc($this->referenceArray, $filteredArray));
    }
    public function provideFilter()
    {
        return [[0, []], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_PUBLIC, ['null' => null, 'empty' => \false, 'public' => 'pub']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_NULL, ['null' => null]], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_EMPTY, ['null' => null, 'empty' => \false]], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VIRTUAL, ["\0~\0virtual" => 'virt']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_DYNAMIC, ["\0+\0dynamic" => 'dyn']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_PROTECTED, ["\0*\0protected" => 'prot']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_PRIVATE, ["\0Foo\0private" => 'priv']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE, ['public' => 'pub', "\0*\0protected" => 'prot'], ['public', "\0*\0protected"]], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_NOT_IMPORTANT, ['null' => null, 'empty' => \false, "\0~\0virtual" => 'virt', "\0+\0dynamic" => 'dyn', "\0Foo\0private" => 'priv'], ['public', "\0*\0protected"]], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VIRTUAL | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_DYNAMIC, ["\0~\0virtual" => 'virt', "\0+\0dynamic" => 'dyn']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_NOT_IMPORTANT | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE, $this->referenceArray, ['public', "\0*\0protected"]], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_NOT_IMPORTANT | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_EMPTY, ['null' => null, 'empty' => \false, "\0~\0virtual" => 'virt', "\0+\0dynamic" => 'dyn', "\0*\0protected" => 'prot', "\0Foo\0private" => 'priv'], ['public', 'empty']], [\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_EMPTY | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_STRICT, ['empty' => \false], ['public', 'empty']]];
    }
    public function testAnonymousClass()
    {
        $c = eval('return new class extends stdClass { private $foo = "foo"; };');
        $this->assertDumpMatchesFormat(<<<'EOTXT'
stdClass@anonymous {
  -foo: "foo"
}
EOTXT
, $c);
        $c = eval('return new class { private $foo = "foo"; };');
        $this->assertDumpMatchesFormat(<<<'EOTXT'
@anonymous {
  -foo: "foo"
}
EOTXT
, $c);
    }
}
