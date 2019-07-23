<?php

namespace _PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Helper;

use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\FormatterHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion;
use _PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question;
/**
 * @group tty
 */
class SymfonyQuestionHelperTest extends \_PhpScoper5d36eb080763e\Symfony\Component\Console\Tests\Helper\AbstractQuestionHelperTest
{
    public function testAskChoice()
    {
        $questionHelper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $helperSet = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet([new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\FormatterHelper()]);
        $questionHelper->setHelperSet($helperSet);
        $heroes = ['Superman', 'Batman', 'Spiderman'];
        $inputStream = $this->getInputStream("\n1\n  1  \nFabien\n1\nFabien\n1\n0,2\n 0 , 2  \n\n\n");
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes, '2');
        $question->setMaxAttempts(1);
        // first answer is an empty answer, we're supposed to receive the default value
        $this->assertEquals('Spiderman', $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $output = $this->createOutputInterface(), $question));
        $this->assertOutputContains('What is your favorite superhero? [Spiderman]', $output);
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes);
        $question->setMaxAttempts(1);
        $this->assertEquals('Batman', $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $this->createOutputInterface(), $question));
        $this->assertEquals('Batman', $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $this->createOutputInterface(), $question));
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes);
        $question->setErrorMessage('Input "%s" is not a superhero!');
        $question->setMaxAttempts(2);
        $this->assertEquals('Batman', $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $output = $this->createOutputInterface(), $question));
        $this->assertOutputContains('Input "Fabien" is not a superhero!', $output);
        try {
            $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes, '1');
            $question->setMaxAttempts(1);
            $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $output = $this->createOutputInterface(), $question);
            $this->fail();
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('Value "Fabien" is invalid', $e->getMessage());
        }
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes, null);
        $question->setMaxAttempts(1);
        $question->setMultiselect(\true);
        $this->assertEquals(['Batman'], $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $this->createOutputInterface(), $question));
        $this->assertEquals(['Superman', 'Spiderman'], $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $this->createOutputInterface(), $question));
        $this->assertEquals(['Superman', 'Spiderman'], $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $this->createOutputInterface(), $question));
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes, '0,1');
        $question->setMaxAttempts(1);
        $question->setMultiselect(\true);
        $this->assertEquals(['Superman', 'Batman'], $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $output = $this->createOutputInterface(), $question));
        $this->assertOutputContains('What is your favorite superhero? [Superman, Batman]', $output);
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', $heroes, ' 0 , 1 ');
        $question->setMaxAttempts(1);
        $question->setMultiselect(\true);
        $this->assertEquals(['Superman', 'Batman'], $questionHelper->ask($this->createStreamableInputInterfaceMock($inputStream), $output = $this->createOutputInterface(), $question));
        $this->assertOutputContains('What is your favorite superhero? [Superman, Batman]', $output);
    }
    public function testAskChoiceWithChoiceValueAsDefault()
    {
        $questionHelper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $helperSet = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\HelperSet([new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\FormatterHelper()]);
        $questionHelper->setHelperSet($helperSet);
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\ChoiceQuestion('What is your favorite superhero?', ['Superman', 'Batman', 'Spiderman'], 'Batman');
        $question->setMaxAttempts(1);
        $this->assertSame('Batman', $questionHelper->ask($this->createStreamableInputInterfaceMock($this->getInputStream("Batman\n")), $output = $this->createOutputInterface(), $question));
        $this->assertOutputContains('What is your favorite superhero? [Batman]', $output);
    }
    public function testAskReturnsNullIfValidatorAllowsIt()
    {
        $questionHelper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $question = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('What is your favorite superhero?');
        $question->setValidator(function ($value) {
            return $value;
        });
        $input = $this->createStreamableInputInterfaceMock($this->getInputStream("\n"));
        $this->assertNull($questionHelper->ask($input, $this->createOutputInterface(), $question));
    }
    public function testAskEscapeDefaultValue()
    {
        $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $input = $this->createStreamableInputInterfaceMock($this->getInputStream('\\'));
        $helper->ask($input, $output = $this->createOutputInterface(), new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Can I have a backslash?', '\\'));
        $this->assertOutputContains('Can I have a backslash? [\\]', $output);
    }
    public function testAskEscapeAndFormatLabel()
    {
        $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $input = $this->createStreamableInputInterfaceMock($this->getInputStream('_PhpScoper5d36eb080763e\\Foo\\Bar'));
        $helper->ask($input, $output = $this->createOutputInterface(), new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Do you want to use Foo\\Bar <comment>or</comment> Foo\\Baz\\?', '_PhpScoper5d36eb080763e\\Foo\\Baz'));
        $this->assertOutputContains('Do you want to use Foo\\Bar or Foo\\Baz\\? [Foo\\Baz]:', $output);
    }
    public function testLabelTrailingBackslash()
    {
        $helper = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $input = $this->createStreamableInputInterfaceMock($this->getInputStream('sure'));
        $helper->ask($input, $output = $this->createOutputInterface(), new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('Question with a trailing \\'));
        $this->assertOutputContains('Question with a trailing \\', $output);
    }
    /**
     * @expectedException        \Symfony\Component\Console\Exception\RuntimeException
     * @expectedExceptionMessage Aborted.
     */
    public function testAskThrowsExceptionOnMissingInput()
    {
        $dialog = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Helper\SymfonyQuestionHelper();
        $dialog->ask($this->createStreamableInputInterfaceMock($this->getInputStream('')), $this->createOutputInterface(), new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Question\Question('What\'s your name?'));
    }
    protected function getInputStream($input)
    {
        $stream = \fopen('php://memory', 'r+', \false);
        \fwrite($stream, $input);
        \rewind($stream);
        return $stream;
    }
    protected function createOutputInterface()
    {
        $output = new \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput(\fopen('php://memory', 'r+', \false));
        $output->setDecorated(\false);
        return $output;
    }
    protected function createInputInterfaceMock($interactive = \true)
    {
        $mock = $this->getMockBuilder('_PhpScoper5d36eb080763e\\Symfony\\Component\\Console\\Input\\InputInterface')->getMock();
        $mock->expects($this->any())->method('isInteractive')->will($this->returnValue($interactive));
        return $mock;
    }
    private function assertOutputContains($expected, \_PhpScoper5d36eb080763e\Symfony\Component\Console\Output\StreamOutput $output)
    {
        \rewind($output->getStream());
        $stream = \stream_get_contents($output->getStream());
        $this->assertContains($expected, $stream);
    }
}
