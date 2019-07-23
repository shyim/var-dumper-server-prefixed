<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\Process\Exception\ProcessFailedException;
use _PhpScoper5d36eb080763e\Symfony\Component\Process\Process;
/**
 * The ProcessHelper class provides helpers to run external processes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final since Symfony 4.2
 */
class ProcessHelper extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\Helper
{
    /**
     * Runs an external process.
     *
     * @param OutputInterface $output    An OutputInterface instance
     * @param array|Process   $cmd       An instance of Process or an array of the command and arguments
     * @param string|null     $error     An error message that must be displayed if something went wrong
     * @param callable|null   $callback  A PHP callback to run whenever there is some
     *                                   output available on STDOUT or STDERR
     * @param int             $verbosity The threshold for verbosity
     *
     * @return Process The process that ran
     */
    public function run(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output, $cmd, $error = null, callable $callback = null, $verbosity = \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE)
    {
        if ($output instanceof \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }
        $formatter = $this->getHelperSet()->get('debug_formatter');
        if ($cmd instanceof \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process) {
            $cmd = [$cmd];
        }
        if (!\is_array($cmd)) {
            @\trigger_error(\sprintf('Passing a command as a string to "%s()" is deprecated since Symfony 4.2, pass it the command as an array of arguments instead.', __METHOD__), \E_USER_DEPRECATED);
            $cmd = [\method_exists(\_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::class, 'fromShellCommandline') ? \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::fromShellCommandline($cmd) : new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process($cmd)];
        }
        if (\is_string($cmd[0] ?? null)) {
            $process = new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process($cmd);
            $cmd = [];
        } elseif (($cmd[0] ?? null) instanceof \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process) {
            $process = $cmd[0];
            unset($cmd[0]);
        } else {
            throw new \InvalidArgumentException(\sprintf('Invalid command provided to "%s()": the command should be an array whose first element is either the path to the binary to run or a "Process" object.', __METHOD__));
        }
        if ($verbosity <= $output->getVerbosity()) {
            $output->write($formatter->start(\spl_object_hash($process), $this->escapeString($process->getCommandLine())));
        }
        if ($output->isDebug()) {
            $callback = $this->wrapCallback($output, $process, $callback);
        }
        $process->run($callback, $cmd);
        if ($verbosity <= $output->getVerbosity()) {
            $message = $process->isSuccessful() ? 'Command ran successfully' : \sprintf('%s Command did not run successfully', $process->getExitCode());
            $output->write($formatter->stop(\spl_object_hash($process), $message, $process->isSuccessful()));
        }
        if (!$process->isSuccessful() && null !== $error) {
            $output->writeln(\sprintf('<error>%s</error>', $this->escapeString($error)));
        }
        return $process;
    }
    /**
     * Runs the process.
     *
     * This is identical to run() except that an exception is thrown if the process
     * exits with a non-zero exit code.
     *
     * @param OutputInterface $output   An OutputInterface instance
     * @param string|Process  $cmd      An instance of Process or a command to run
     * @param string|null     $error    An error message that must be displayed if something went wrong
     * @param callable|null   $callback A PHP callback to run whenever there is some
     *                                  output available on STDOUT or STDERR
     *
     * @return Process The process that ran
     *
     * @throws ProcessFailedException
     *
     * @see run()
     */
    public function mustRun(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output, $cmd, $error = null, callable $callback = null)
    {
        $process = $this->run($output, $cmd, $error, $callback);
        if (!$process->isSuccessful()) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Process\Exception\ProcessFailedException($process);
        }
        return $process;
    }
    /**
     * Wraps a Process callback to add debugging output.
     *
     * @param OutputInterface $output   An OutputInterface interface
     * @param Process         $process  The Process
     * @param callable|null   $callback A PHP callable
     *
     * @return callable
     */
    public function wrapCallback(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\OutputInterface $output, \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process $process, callable $callback = null)
    {
        if ($output instanceof \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }
        $formatter = $this->getHelperSet()->get('debug_formatter');
        return function ($type, $buffer) use($output, $process, $callback, $formatter) {
            $output->write($formatter->progress(\spl_object_hash($process), $this->escapeString($buffer), \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::ERR === $type));
            if (null !== $callback) {
                $callback($type, $buffer);
            }
        };
    }
    private function escapeString($str)
    {
        return \str_replace('<', '\\<', $str);
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'process';
    }
}
