<?php

namespace _PhpScoper5d36eb080763e;

use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Data;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\DumpServer;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper;
$componentRoot = $_SERVER['COMPONENT_ROOT'];
if (!\is_file($file = $componentRoot . '/vendor/autoload.php')) {
    $file = $componentRoot . '/../../../../vendor/autoload.php';
}
require $file;
$cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
$cloner->setMaxItems(-1);
$dumper = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper(null, null, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper::DUMP_LIGHT_ARRAY | \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper::DUMP_STRING_LENGTH);
$dumper->setColors(\false);
\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper::setHandler(function ($var) use($cloner, $dumper) {
    $data = $cloner->cloneVar($var)->withRefHandles(\false);
    $dumper->dump($data);
});
$server = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\DumpServer(\getenv('VAR_DUMPER_SERVER'));
$server->start();
echo "READY\n";
$server->listen(function (\_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\Data $data, array $context, $clientId) {
    \_PhpScoper5d36eb080763e\dump((string) $data, $context, $clientId);
    exit(0);
});
