<?php

namespace _PhpScoper5d36eb080763e;

/* foo.twig */
class __TwigTemplate_VarDumperFixture_u75a09 extends \_PhpScoper5d36eb080763e\Twig\Template
{
    private $path;
    public function __construct(\_PhpScoper5d36eb080763e\Twig\Environment $env = null, $path = null)
    {
        if (null !== $env) {
            parent::__construct($env);
        }
        $this->parent = \false;
        $this->blocks = [];
        $this->path = $path;
    }
    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 2
        throw new \Exception('Foobar');
    }
    public function getTemplateName()
    {
        return 'foo.twig';
    }
    public function getDebugInfo()
    {
        return [20 => 1, 21 => 2];
    }
    public function getSourceContext()
    {
        return new \_PhpScoper5d36eb080763e\Twig\Source("   foo bar\n     twig source\n\n", 'foo.twig', $this->path ?: __FILE__);
    }
}
/* foo.twig */
\class_alias('_PhpScoper5d36eb080763e\\__TwigTemplate_VarDumperFixture_u75a09', '__TwigTemplate_VarDumperFixture_u75a09', \false);
