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

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\MarkdownDescriptor;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplicationMbString;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorCommandMbString;
class MarkdownDescriptorTest extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\AbstractDescriptorTest
{
    public function getDescribeCommandTestData()
    {
        return $this->getDescriptionTestData(\array_merge(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\ObjectsProvider::getCommands(), ['command_mbstring' => new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorCommandMbString()]));
    }
    public function getDescribeApplicationTestData()
    {
        return $this->getDescriptionTestData(\array_merge(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\ObjectsProvider::getApplications(), ['application_mbstring' => new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplicationMbString()]));
    }
    protected function getDescriptor()
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\MarkdownDescriptor();
    }
    protected function getFormat()
    {
        return 'md';
    }
}
