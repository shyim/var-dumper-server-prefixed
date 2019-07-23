<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Psr\Container\ContainerInterface;
use _PhpScoper5d36eb080763e\Symfony\Contracts\Service\ServiceLocatorTrait;
use _PhpScoper5d36eb080763e\Symfony\Contracts\Service\ServiceSubscriberInterface;
use _PhpScoper5d36eb080763e\Symfony\Contracts\Service\ServiceSubscriberTrait;
class ServiceSubscriberTraitTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testMethodsOnParentsAndChildrenAreIgnoredInGetSubscribedServices()
    {
        $expected = [\_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\TestService::class . '::aService' => '_PhpScoper5d36eb080763e\\?Symfony\\Contracts\\Tests\\Service\\Service2'];
        $this->assertEquals($expected, \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\ChildTestService::getSubscribedServices());
    }
    public function testSetContainerIsCalledOnParent()
    {
        $container = new class([]) implements \_PhpScoper5d36eb080763e\Psr\Container\ContainerInterface
        {
            use ServiceLocatorTrait;
        };
        $this->assertSame($container, (new \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\TestService())->setContainer($container));
    }
}
class ParentTestService
{
    public function aParentService() : \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\Service1
    {
    }
    public function setContainer(\_PhpScoper5d36eb080763e\Psr\Container\ContainerInterface $container)
    {
        return $container;
    }
}
class TestService extends \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\ParentTestService implements \_PhpScoper5d36eb080763e\Symfony\Contracts\Service\ServiceSubscriberInterface
{
    use ServiceSubscriberTrait;
    public function aService() : \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\Service2
    {
    }
}
class ChildTestService extends \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\TestService
{
    public function aChildService() : \_PhpScoper5d36eb080763e\Symfony\Contracts\Tests\Service\Service3
    {
    }
}
