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
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\DebugFormatterHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProcessHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Process\Process;
class ProcessHelperTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideCommandsAndOutput
     */
    public function testVariousProcessRuns($expected, $cmd, $verbosity, $error)
    {
        if (\is_string($cmd)) {
            $cmd = \method_exists(\_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::class, 'fromShellCommandline') ? \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::fromShellCommandline($cmd) : new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process($cmd);
        }
        $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProcessHelper();
        $helper->setHelperSet(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet([new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\DebugFormatterHelper()]));
        $output = $this->getOutputStream($verbosity);
        $helper->run($output, $cmd, $error);
        $this->assertEquals($expected, $this->getOutput($output));
    }
    public function testPassedCallbackIsExecuted()
    {
        $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\ProcessHelper();
        $helper->setHelperSet(new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet([new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\DebugFormatterHelper()]));
        $output = $this->getOutputStream(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_NORMAL);
        $executed = \false;
        $callback = function () use(&$executed) {
            $executed = \true;
        };
        $helper->run($output, ['php', '-r', 'echo 42;'], null, $callback);
        $this->assertTrue($executed);
    }
    public function provideCommandsAndOutput()
    {
        $successOutputVerbose = <<<'EOT'
  RUN  php -r "echo 42;"
  RES  Command ran successfully

EOT;
        $successOutputDebug = <<<'EOT'
  RUN  php -r "echo 42;"
  OUT  42
  RES  Command ran successfully

EOT;
        $successOutputDebugWithTags = <<<'EOT'
  RUN  php -r "echo '<info>42</info>';"
  OUT  <info>42</info>
  RES  Command ran successfully

EOT;
        $successOutputProcessDebug = <<<'EOT'
  RUN  'php' '-r' 'echo 42;'
  OUT  42
  RES  Command ran successfully

EOT;
        $syntaxErrorOutputVerbose = <<<'EOT'
  RUN  php -r "fwrite(STDERR, 'error message');usleep(50000);fwrite(STDOUT, 'out message');exit(252);"
  RES  252 Command did not run successfully

EOT;
        $syntaxErrorOutputDebug = <<<'EOT'
  RUN  php -r "fwrite(STDERR, 'error message');usleep(500000);fwrite(STDOUT, 'out message');exit(252);"
  ERR  error message
  OUT  out message
  RES  252 Command did not run successfully

EOT;
        $PHP = '\\' === \DIRECTORY_SEPARATOR ? '"!PHP!"' : '"$PHP"';
        $successOutputPhp = <<<EOT
  RUN  php -r {$PHP}
  OUT  42
  RES  Command ran successfully

EOT;
        $errorMessage = 'An error occurred';
        $args = new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process(['php', '-r', 'echo 42;']);
        $args = $args->getCommandLine();
        $successOutputProcessDebug = \str_replace("'php' '-r' 'echo 42;'", $args, $successOutputProcessDebug);
        $fromShellCommandline = \method_exists(\_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::class, 'fromShellCommandline') ? [\_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::class, 'fromShellCommandline'] : function ($cmd) {
            return new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process($cmd);
        };
        return [['', 'php -r "echo 42;"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERBOSE, null], [$successOutputVerbose, 'php -r "echo 42;"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERY_VERBOSE, null], [$successOutputDebug, 'php -r "echo 42;"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], [$successOutputDebugWithTags, 'php -r "echo \'<info>42</info>\';"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], ['', 'php -r "syntax error"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERBOSE, null], [$syntaxErrorOutputVerbose, 'php -r "fwrite(STDERR, \'error message\');usleep(50000);fwrite(STDOUT, \'out message\');exit(252);"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERY_VERBOSE, null], [$syntaxErrorOutputDebug, 'php -r "fwrite(STDERR, \'error message\');usleep(500000);fwrite(STDOUT, \'out message\');exit(252);"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], [$errorMessage . \PHP_EOL, 'php -r "fwrite(STDERR, \'error message\');usleep(50000);fwrite(STDOUT, \'out message\');exit(252);"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERBOSE, $errorMessage], [$syntaxErrorOutputVerbose . $errorMessage . \PHP_EOL, 'php -r "fwrite(STDERR, \'error message\');usleep(50000);fwrite(STDOUT, \'out message\');exit(252);"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_VERY_VERBOSE, $errorMessage], [$syntaxErrorOutputDebug . $errorMessage . \PHP_EOL, 'php -r "fwrite(STDERR, \'error message\');usleep(500000);fwrite(STDOUT, \'out message\');exit(252);"', \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, $errorMessage], [$successOutputProcessDebug, ['php', '-r', 'echo 42;'], \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], [$successOutputDebug, $fromShellCommandline('php -r "echo 42;"'), \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], [$successOutputProcessDebug, [new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process(['php', '-r', 'echo 42;'])], \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null], [$successOutputPhp, [$fromShellCommandline('php -r ' . $PHP), 'PHP' => 'echo 42;'], \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput::VERBOSITY_DEBUG, null]];
    }
    private function getOutputStream($verbosity)
    {
        return new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput(\fopen('php://memory', 'r+', \false), $verbosity, \false);
    }
    private function getOutput(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput $output)
    {
        \rewind($output->getStream());
        return \stream_get_contents($output->getStream());
    }
}
