<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Input;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\InvalidArgumentException;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\RuntimeException;
/**
 * Input is the base class for all concrete Input classes.
 *
 * Three concrete classes are provided by default:
 *
 *  * `ArgvInput`: The input comes from the CLI arguments (argv)
 *  * `StringInput`: The input is provided as a string
 *  * `ArrayInput`: The input is provided as an array
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class Input implements \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputInterface, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\StreamableInputInterface
{
    protected $definition;
    protected $stream;
    protected $options = [];
    protected $arguments = [];
    protected $interactive = \true;
    public function __construct(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputDefinition $definition = null)
    {
        if (null === $definition) {
            $this->definition = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputDefinition();
        } else {
            $this->bind($definition);
            $this->validate();
        }
    }
    /**
     * {@inheritdoc}
     */
    public function bind(\_PhpScoper5d36eb080763e\Symfony\Component\Console\Input\InputDefinition $definition)
    {
        $this->arguments = [];
        $this->options = [];
        $this->definition = $definition;
        $this->parse();
    }
    /**
     * Processes command line arguments.
     */
    protected abstract function parse();
    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        $definition = $this->definition;
        $givenArguments = $this->arguments;
        $missingArguments = \array_filter(\array_keys($definition->getArguments()), function ($argument) use($definition, $givenArguments) {
            return !\array_key_exists($argument, $givenArguments) && $definition->getArgument($argument)->isRequired();
        });
        if (\count($missingArguments) > 0) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\RuntimeException(\sprintf('Not enough arguments (missing: "%s").', \implode(', ', $missingArguments)));
        }
    }
    /**
     * {@inheritdoc}
     */
    public function isInteractive()
    {
        return $this->interactive;
    }
    /**
     * {@inheritdoc}
     */
    public function setInteractive($interactive)
    {
        $this->interactive = (bool) $interactive;
    }
    /**
     * {@inheritdoc}
     */
    public function getArguments()
    {
        return \array_merge($this->definition->getArgumentDefaults(), $this->arguments);
    }
    /**
     * {@inheritdoc}
     */
    public function getArgument($name)
    {
        if (!$this->definition->hasArgument($name)) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('The "%s" argument does not exist.', $name));
        }
        return isset($this->arguments[$name]) ? $this->arguments[$name] : $this->definition->getArgument($name)->getDefault();
    }
    /**
     * {@inheritdoc}
     */
    public function setArgument($name, $value)
    {
        if (!$this->definition->hasArgument($name)) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('The "%s" argument does not exist.', $name));
        }
        $this->arguments[$name] = $value;
    }
    /**
     * {@inheritdoc}
     */
    public function hasArgument($name)
    {
        return $this->definition->hasArgument($name);
    }
    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return \array_merge($this->definition->getOptionDefaults(), $this->options);
    }
    /**
     * {@inheritdoc}
     */
    public function getOption($name)
    {
        if (!$this->definition->hasOption($name)) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('The "%s" option does not exist.', $name));
        }
        return \array_key_exists($name, $this->options) ? $this->options[$name] : $this->definition->getOption($name)->getDefault();
    }
    /**
     * {@inheritdoc}
     */
    public function setOption($name, $value)
    {
        if (!$this->definition->hasOption($name)) {
            throw new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('The "%s" option does not exist.', $name));
        }
        $this->options[$name] = $value;
    }
    /**
     * {@inheritdoc}
     */
    public function hasOption($name)
    {
        return $this->definition->hasOption($name);
    }
    /**
     * Escapes a token through escapeshellarg if it contains unsafe chars.
     *
     * @param string $token
     *
     * @return string
     */
    public function escapeToken($token)
    {
        return \preg_match('{^[\\w-]+$}', $token) ? $token : \escapeshellarg($token);
    }
    /**
     * {@inheritdoc}
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }
    /**
     * {@inheritdoc}
     */
    public function getStream()
    {
        return $this->stream;
    }
}
