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

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\TextDescriptor;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplication2;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplicationMbString;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorCommandMbString;
class TextDescriptorTest extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\AbstractDescriptorTest
{
    public function getDescribeCommandTestData()
    {
        return $this->getDescriptionTestData(\array_merge(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\ObjectsProvider::getCommands(), ['command_mbstring' => new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorCommandMbString()]));
    }
    public function getDescribeApplicationTestData()
    {
        return $this->getDescriptionTestData(\array_merge(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Descriptor\ObjectsProvider::getApplications(), ['application_mbstring' => new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplicationMbString()]));
    }
    public function testDescribeApplicationWithFilteredNamespace()
    {
        $application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Fixtures\DescriptorApplication2();
        $this->assertDescription(\file_get_contents(__DIR__ . '/../Fixtures/application_filtered_namespace.txt'), $application, ['namespace' => 'command4']);
    }
    protected function getDescriptor()
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Descriptor\TextDescriptor();
    }
    protected function getFormat()
    {
        return 'txt';
    }
}
