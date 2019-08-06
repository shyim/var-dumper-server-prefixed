<?php

use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ServerDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\DumpServer;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper;
require \dirname(__DIR__) . '/vendor/autoload.php';
$cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
$cloner->setMaxItems(-1);
// SERVER
$dumpServer = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Server\DumpServer('127.0.0.1:54548');
// CLIENT
$serverDumper = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ServerDumper('127.0.0.1:54548', new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\CliDumper(), [new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider(), new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider()]);
if (!\function_exists('swdump')) {
    function swdump($var)
    {
        global $cloner, $serverDumper;
        $data = $cloner->cloneVar($var);
        $serverDumper->dump($data);
    }
}
if (!\function_exists('_quote')) {
    function _quote($value)
    {
        if (\is_int($value)) {
            return $value;
        } elseif (\is_float($value)) {
            return \sprintf('%F', $value);
        }
        return "'" . \addcslashes($value, "\0\n\r\\'\"\32") . "'";
    }
}
if (!\function_exists('swdd')) {
    function swdd(...$vars)
    {
        foreach ($vars as $v) {
            \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\VarDumper::dump($v);
        }
        die();
    }
}
if (!\function_exists('sqlformat')) {
    function sqlformat($qb)
    {
        $params = \array_map(function ($data) {
            return _quote($data);
        }, $qb->getParameters());
        echo \_PhpScoper5d36eb080763e\SqlFormatter::format(\str_replace(\array_keys($params), \array_values($params), $qb->getSQL()));
        die;
    }
}
if (!\function_exists('sqlformatraw')) {
    function sqlformatraw($query)
    {
        echo \_PhpScoper5d36eb080763e\SqlFormatter::format($query);
        die;
    }
}
