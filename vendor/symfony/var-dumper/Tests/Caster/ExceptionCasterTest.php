<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Tests\Caster;

use _PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\FrameStub;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\HtmlDumper;
use _PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Test\VarDumperTestTrait;
class ExceptionCasterTest extends \_PhpScoper5d36eb080763e\PHPUnit\Framework\TestCase
{
    use VarDumperTestTrait;
    private function getTestException($msg, &$ref = null)
    {
        return new \Exception('' . $msg);
    }
    protected function tearDown()
    {
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster::$srcContext = 1;
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster::$traceArgs = \true;
    }
    public function testDefaultSettings()
    {
        $ref = ['foo'];
        $e = $this->getTestException('foo', $ref);
        $expectedDump = <<<'EODUMP'
Exception {
  #message: "foo"
  #code: 0
  #file: "%sExceptionCasterTest.php"
  #line: 28
  trace: {
    %s%eTests%eCaster%eExceptionCasterTest.php:28 {
      › {
      ›     return new \Exception(''.$msg);
      › }
    }
    %s%eTests%eCaster%eExceptionCasterTest.php:40 { …}
    Symfony\Component\VarDumper\Tests\Caster\ExceptionCasterTest->testDefaultSettings() {}
%A
EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $e);
        $this->assertSame(['foo'], $ref);
    }
    public function testSeek()
    {
        $e = $this->getTestException(2);
        $expectedDump = <<<'EODUMP'
{
  %s%eTests%eCaster%eExceptionCasterTest.php:28 {
    › {
    ›     return new \Exception(''.$msg);
    › }
  }
  %s%eTests%eCaster%eExceptionCasterTest.php:65 { …}
  Symfony\Component\VarDumper\Tests\Caster\ExceptionCasterTest->testSeek() {}
%A
EODUMP;
        $this->assertStringMatchesFormat($expectedDump, $this->getDump($e, 'trace'));
    }
    public function testNoArgs()
    {
        $e = $this->getTestException(1);
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster::$traceArgs = \false;
        $expectedDump = <<<'EODUMP'
Exception {
  #message: "1"
  #code: 0
  #file: "%sExceptionCasterTest.php"
  #line: 28
  trace: {
    %sExceptionCasterTest.php:28 {
      › {
      ›     return new \Exception(''.$msg);
      › }
    }
    %s%eTests%eCaster%eExceptionCasterTest.php:84 { …}
    Symfony\Component\VarDumper\Tests\Caster\ExceptionCasterTest->testNoArgs() {}
%A
EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $e);
    }
    public function testNoSrcContext()
    {
        $e = $this->getTestException(1);
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster::$srcContext = -1;
        $expectedDump = <<<'EODUMP'
Exception {
  #message: "1"
  #code: 0
  #file: "%sExceptionCasterTest.php"
  #line: 28
  trace: {
    %s%eTests%eCaster%eExceptionCasterTest.php:28
    %s%eTests%eCaster%eExceptionCasterTest.php:%d
%A
EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $e);
    }
    public function testHtmlDump()
    {
        if (\ini_get('xdebug.file_link_format') || \get_cfg_var('xdebug.file_link_format')) {
            $this->markTestSkipped('A custom file_link_format is defined.');
        }
        $e = $this->getTestException(1);
        \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\ExceptionCaster::$srcContext = -1;
        $cloner = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Cloner\VarCloner();
        $cloner->setMaxItems(1);
        $dumper = new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Dumper\HtmlDumper();
        $dumper->setDumpHeader('<foo></foo>');
        $dumper->setDumpBoundaries('<bar>', '</bar>');
        $dump = $dumper->dump($cloner->cloneVar($e)->withRefHandles(\false), \true);
        $expectedDump = <<<'EODUMP'
<foo></foo><bar><span class=sf-dump-note>Exception</span> {<samp>
  #<span class=sf-dump-protected title="Protected property">message</span>: "<span class=sf-dump-str>1</span>"
  #<span class=sf-dump-protected title="Protected property">code</span>: <span class=sf-dump-num>0</span>
  #<span class=sf-dump-protected title="Protected property">file</span>: "<span class=sf-dump-str title="%sExceptionCasterTest.php
%d characters"><span class="sf-dump-ellipsis sf-dump-ellipsis-path">%s%eVarDumper</span><span class=sf-dump-ellipsis>%e</span>Tests%eCaster%eExceptionCasterTest.php</span>"
  #<span class=sf-dump-protected title="Protected property">line</span>: <span class=sf-dump-num>28</span>
  <span class=sf-dump-meta>trace</span>: {<samp>
    <span class=sf-dump-meta title="%sExceptionCasterTest.php
Stack level %d."><span class="sf-dump-ellipsis sf-dump-ellipsis-path">%s%eVarDumper</span><span class=sf-dump-ellipsis>%e</span>Tests%eCaster%eExceptionCasterTest.php</span>:<span class=sf-dump-num>28</span>
     &hellip;%d
  </samp>}
</samp>}
</bar>
EODUMP;
        $this->assertStringMatchesFormat($expectedDump, $dump);
    }
    /**
     * @requires function Twig\Template::getSourceContext
     */
    public function testFrameWithTwig()
    {
        require_once \dirname(__DIR__) . '/Fixtures/Twig.php';
        $f = [new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\FrameStub(['file' => \dirname(__DIR__) . '/Fixtures/Twig.php', 'line' => 20, 'class' => '__TwigTemplate_VarDumperFixture_u75a09']), new \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\FrameStub(['file' => \dirname(__DIR__) . '/Fixtures/Twig.php', 'line' => 21, 'class' => '__TwigTemplate_VarDumperFixture_u75a09', 'object' => new \_PhpScoper5d36eb080763e\__TwigTemplate_VarDumperFixture_u75a09(null, __FILE__)])];
        $expectedDump = <<<'EODUMP'
array:2 [
  0 => {
    class: "__TwigTemplate_VarDumperFixture_u75a09"
    src: {
      %sTwig.php:1 {
        › 
        › foo bar
        ›   twig source
      }
    }
  }
  1 => {
    class: "__TwigTemplate_VarDumperFixture_u75a09"
    object: __TwigTemplate_VarDumperFixture_u75a09 {
    %A
    }
    src: {
      %sExceptionCasterTest.php:2 {
        › foo bar
        ›   twig source
        › 
      }
    }
  }
]

EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $f);
    }
    public function testExcludeVerbosity()
    {
        $e = $this->getTestException('foo');
        $expectedDump = <<<'EODUMP'
Exception {
  #message: "foo"
  #code: 0
  #file: "%sExceptionCasterTest.php"
  #line: 28
}
EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $e, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE);
    }
    public function testAnonymous()
    {
        $e = new \Exception(\sprintf('Boo "%s" ba.', \get_class(new class('Foo') extends \Exception
        {
        })));
        $expectedDump = <<<'EODUMP'
Exception {
  #message: "Boo "Exception@anonymous" ba."
  #code: 0
  #file: "%sExceptionCasterTest.php"
  #line: %d
}
EODUMP;
        $this->assertDumpMatchesFormat($expectedDump, $e, \_PhpScoper5d36eb080763e\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE);
    }
}
