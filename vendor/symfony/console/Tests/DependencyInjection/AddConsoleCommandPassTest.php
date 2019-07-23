<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ChildDefinition;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition;
use _PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\TypedReference;
class AddConsoleCommandPassTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider visibilityProvider
     */
    public function testProcess($public)
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $container->setParameter('my-command.class', '_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\DependencyInjection\\MyCommand');
        $id = 'my-command';
        $definition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition('%my-command.class%');
        $definition->setPublic($public);
        $definition->addTag('console.command');
        $container->setDefinition($id, $definition);
        $container->compile();
        $alias = 'console.command.public_alias.my-command';
        if ($public) {
            $this->assertFalse($container->hasAlias($alias));
        } else {
            // The alias is replaced by a Definition by the ReplaceAliasByActualDefinitionPass
            // in case the original service is private
            $this->assertFalse($container->hasDefinition($id));
            $this->assertTrue($container->hasDefinition($alias));
        }
        $this->assertTrue($container->hasParameter('console.command.ids'));
        $this->assertSame([$public ? $id : $alias], $container->getParameter('console.command.ids'));
    }
    public function testProcessRegistersLazyCommands()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $command = $container->register('my-command', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection\MyCommand::class)->setPublic(\false)->addTag('console.command', ['command' => 'my:command'])->addTag('console.command', ['command' => 'my:alias']);
        (new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass())->process($container);
        $commandLoader = $container->getDefinition('console.command_loader');
        $commandLocator = $container->getDefinition((string) $commandLoader->getArgument(0));
        $this->assertSame(\_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader::class, $commandLoader->getClass());
        $this->assertSame(['my:command' => 'my-command', 'my:alias' => 'my-command'], $commandLoader->getArgument(1));
        $this->assertEquals([['my-command' => new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\TypedReference('my-command', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection\MyCommand::class))]], $commandLocator->getArguments());
        $this->assertSame([], $container->getParameter('console.command.ids'));
        $this->assertSame([['setName', ['my:command']], ['setAliases', [['my:alias']]]], $command->getMethodCalls());
    }
    public function testProcessFallsBackToDefaultName()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->register('with-default-name', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection\NamedCommand::class)->setPublic(\false)->addTag('console.command');
        $pass = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass();
        $pass->process($container);
        $commandLoader = $container->getDefinition('console.command_loader');
        $commandLocator = $container->getDefinition((string) $commandLoader->getArgument(0));
        $this->assertSame(\_PhpScoper5d36eb080763e\Symfony\Component\Console\CommandLoader\ContainerCommandLoader::class, $commandLoader->getClass());
        $this->assertSame(['default' => 'with-default-name'], $commandLoader->getArgument(1));
        $this->assertEquals([['with-default-name' => new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument(new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\TypedReference('with-default-name', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection\NamedCommand::class))]], $commandLocator->getArguments());
        $this->assertSame([], $container->getParameter('console.command.ids'));
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->register('with-default-name', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\DependencyInjection\NamedCommand::class)->setPublic(\false)->addTag('console.command', ['command' => 'new-name']);
        $pass->process($container);
        $this->assertSame(['new-name' => 'with-default-name'], $container->getDefinition('console.command_loader')->getArgument(1));
    }
    public function visibilityProvider()
    {
        return [[\true], [\false]];
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The service "my-command" tagged "console.command" must not be abstract.
     */
    public function testProcessThrowAnExceptionIfTheServiceIsAbstract()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->setResourceTracking(\false);
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $definition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition('_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\DependencyInjection\\MyCommand');
        $definition->addTag('console.command');
        $definition->setAbstract(\true);
        $container->setDefinition('my-command', $definition);
        $container->compile();
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The service "my-command" tagged "console.command" must be a subclass of "Symfony\Component\Console\Command\Command".
     */
    public function testProcessThrowAnExceptionIfTheServiceIsNotASubclassOfCommand()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->setResourceTracking(\false);
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $definition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition('SplObjectStorage');
        $definition->addTag('console.command');
        $container->setDefinition('my-command', $definition);
        $container->compile();
    }
    public function testProcessPrivateServicesWithSameCommand()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $className = '_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\DependencyInjection\\MyCommand';
        $definition1 = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition($className);
        $definition1->addTag('console.command')->setPublic(\false);
        $definition2 = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition($className);
        $definition2->addTag('console.command')->setPublic(\false);
        $container->setDefinition('my-command1', $definition1);
        $container->setDefinition('my-command2', $definition2);
        (new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass())->process($container);
        $aliasPrefix = 'console.command.public_alias.';
        $this->assertTrue($container->hasAlias($aliasPrefix . 'my-command1'));
        $this->assertTrue($container->hasAlias($aliasPrefix . 'my-command2'));
    }
    public function testProcessOnChildDefinitionWithClass()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $className = '_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\DependencyInjection\\MyCommand';
        $parentId = 'my-parent-command';
        $childId = 'my-child-command';
        $parentDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition();
        $parentDefinition->setAbstract(\true)->setPublic(\false);
        $childDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ChildDefinition($parentId);
        $childDefinition->addTag('console.command')->setPublic(\true);
        $childDefinition->setClass($className);
        $container->setDefinition($parentId, $parentDefinition);
        $container->setDefinition($childId, $childDefinition);
        $container->compile();
        $command = $container->get($childId);
        $this->assertInstanceOf($className, $command);
    }
    public function testProcessOnChildDefinitionWithParentClass()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $className = '_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Tests\\DependencyInjection\\MyCommand';
        $parentId = 'my-parent-command';
        $childId = 'my-child-command';
        $parentDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition($className);
        $parentDefinition->setAbstract(\true)->setPublic(\false);
        $childDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ChildDefinition($parentId);
        $childDefinition->addTag('console.command')->setPublic(\true);
        $container->setDefinition($parentId, $parentDefinition);
        $container->setDefinition($childId, $childDefinition);
        $container->compile();
        $command = $container->get($childId);
        $this->assertInstanceOf($className, $command);
    }
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The definition for "my-child-command" has no class.
     */
    public function testProcessOnChildDefinitionWithoutClass()
    {
        $container = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ContainerBuilder();
        $container->addCompilerPass(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass(), \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_REMOVING);
        $parentId = 'my-parent-command';
        $childId = 'my-child-command';
        $parentDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\Definition();
        $parentDefinition->setAbstract(\true)->setPublic(\false);
        $childDefinition = new \_PhpScoper5d36eb080763e\Symfony\Component\DependencyInjection\ChildDefinition($parentId);
        $childDefinition->addTag('console.command')->setPublic(\true);
        $container->setDefinition($parentId, $parentDefinition);
        $container->setDefinition($childId, $childDefinition);
        $container->compile();
    }
}
class MyCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
}
class NamedCommand extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'default';
}
