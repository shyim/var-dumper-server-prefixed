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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StreamableInputInterface;
abstract class AbstractQuestionHelperTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    protected function createStreamableInputInterfaceMock($stream = null, $interactive = \true)
    {
        $mock = $this->getMockBuilder(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StreamableInputInterface::class)->getMock();
        $mock->expects($this->any())->method('isInteractive')->will($this->returnValue($interactive));
        if ($stream) {
            $mock->expects($this->any())->method('getStream')->willReturn($stream);
        }
        return $mock;
    }
}
