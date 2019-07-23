<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Helper;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\TableStyle;
class TableStyleTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Invalid padding type. Expected one of (STR_PAD_LEFT, STR_PAD_RIGHT, STR_PAD_BOTH).
     */
    public function testSetPadTypeWithInvalidType()
    {
        $style = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\TableStyle();
        $style->setPadType('TEST');
    }
}
