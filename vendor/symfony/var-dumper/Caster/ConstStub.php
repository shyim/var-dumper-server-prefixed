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
 * Represents a PHP constant and its value.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ConstStub extends \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Stub
{
    public function __construct(string $name, $value)
    {
        $this->class = $name;
        $this->value = $value;
    }
    public function __toString()
    {
        return (string) $this->value;
    }
}
