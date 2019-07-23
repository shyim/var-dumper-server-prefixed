<?php

namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Fixtures;

class GeneratorDemo
{
    public static function foo()
    {
        (yield 1);
    }
    public function baz()
    {
        yield from bar();
    }
}
function bar()
{
    yield from \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Fixtures\GeneratorDemo::foo();
}
