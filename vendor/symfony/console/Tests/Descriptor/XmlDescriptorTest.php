<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\XmlDescriptor;
class XmlDescriptorTest extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\AbstractDescriptorTest
{
    protected function getDescriptor()
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\XmlDescriptor();
    }
    protected function getFormat()
    {
        return 'xml';
    }
}
