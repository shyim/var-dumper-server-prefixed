<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Server;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\Process\PhpProcess;
use _PhpScoper5d36eb080763e\Symfony\Component\Process\Process;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\Connection;
class ConnectionTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    private const VAR_DUMPER_SERVER = 'tcp://127.0.0.1:9913';
    public function testDump()
    {
        $cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
        $data = $cloner->cloneVar('foo');
        $connection = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\Connection(self::VAR_DUMPER_SERVER, ['foo_provider' => new class implements \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface
        {
            public function getContext() : ?array
            {
                return ['foo'];
            }
        }]);
        $dumped = null;
        $process = $this->getServerProcess();
        $process->start(function ($type, $buffer) use($process, &$dumped, $connection, $data) {
            if (\_PhpScoper5d36eb080763e\Symfony\Component\Process\Process::ERR === $type) {
                $process->stop();
                $this->fail();
            } elseif ("READY\n" === $buffer) {
                $connection->write($data);
            } else {
                $dumped .= $buffer;
            }
        });
        $process->wait();
        $this->assertTrue($process->isSuccessful());
        $this->assertStringMatchesFormat(<<<'DUMP'
(3) "foo"
[
  "timestamp" => %d.%d
  "foo_provider" => [
    (3) "foo"
  ]
]
%d

DUMP
, $dumped);
    }
    public function testNoServer()
    {
        $cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
        $data = $cloner->cloneVar('foo');
        $connection = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\Connection(self::VAR_DUMPER_SERVER);
        $start = \microtime(\true);
        $this->assertFalse($connection->write($data));
        $this->assertLessThan(1, \microtime(\true) - $start);
    }
    private function getServerProcess() : \_PhpScoper5d36eb080763e\Symfony\Component\Process\Process
    {
        $process = new \_PhpScoper5d36eb080763e\Symfony\Component\Process\PhpProcess(\file_get_contents(__DIR__ . '/../Fixtures/dump_server.php'), null, ['COMPONENT_ROOT' => __DIR__ . '/../../', 'VAR_DUMPER_SERVER' => self::VAR_DUMPER_SERVER]);
        $process->inheritEnvironmentVariables(\true);
        return $process->setTimeout(9);
    }
}
