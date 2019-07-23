<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Command;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Application;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\HelpCommand;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Command\ListCommand;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester;
class HelpCommandTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    public function testExecuteForCommandAlias()
    {
        $command = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\HelpCommand();
        $command->setApplication(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application());
        $commandTester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $commandTester->execute(['command_name' => 'li'], ['decorated' => \false]);
        $this->assertContains('list [options] [--] [<namespace>]', $commandTester->getDisplay(), '->execute() returns a text help for the given command alias');
        $this->assertContains('format=FORMAT', $commandTester->getDisplay(), '->execute() returns a text help for the given command alias');
        $this->assertContains('raw', $commandTester->getDisplay(), '->execute() returns a text help for the given command alias');
    }
    public function testExecuteForCommand()
    {
        $command = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\HelpCommand();
        $commandTester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $command->setCommand(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\ListCommand());
        $commandTester->execute([], ['decorated' => \false]);
        $this->assertContains('list [options] [--] [<namespace>]', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
        $this->assertContains('format=FORMAT', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
        $this->assertContains('raw', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
    }
    public function testExecuteForCommandWithXmlOption()
    {
        $command = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\HelpCommand();
        $commandTester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($command);
        $command->setCommand(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Command\ListCommand());
        $commandTester->execute(['--format' => 'xml']);
        $this->assertContains('<command', $commandTester->getDisplay(), '->execute() returns an XML help text if --xml is passed');
    }
    public function testExecuteForApplicationCommand()
    {
        $application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application();
        $commandTester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($application->get('help'));
        $commandTester->execute(['command_name' => 'list']);
        $this->assertContains('list [options] [--] [<namespace>]', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
        $this->assertContains('format=FORMAT', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
        $this->assertContains('raw', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
    }
    public function testExecuteForApplicationCommandWithXmlOption()
    {
        $application = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Application();
        $commandTester = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tester\CommandTester($application->get('help'));
        $commandTester->execute(['command_name' => 'list', '--format' => 'xml']);
        $this->assertContains('list [--raw] [--format FORMAT] [--] [&lt;namespace&gt;]', $commandTester->getDisplay(), '->execute() returns a text help for the given command');
        $this->assertContains('<command', $commandTester->getDisplay(), '->execute() returns an XML help text if --format=xml is passed');
    }
}
