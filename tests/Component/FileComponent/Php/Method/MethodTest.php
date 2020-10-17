<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Method;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Common\Php\VariableInterface;
use GrizzIt\Ast\Component\FileComponent\Php\Value\Value;
use GrizzIt\Ast\Component\FileComponent\Php\Method\Method;
use GrizzIt\Ast\Component\FileComponent\Php\Variable\Variable;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Method\Method
 * @covers \GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait
 */
class MethodTest extends TestCase
{
    /**
     * @covers ::getParameters
     * @covers ::setParameters
     * @covers ::setIsAbstract
     * @covers ::isAbstract
     * @covers ::setMethodContent
     * @covers ::getMethodContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = 'foo';
        $visibility = 'public';
        $type = 'string';
        $description = 'Description for a method.';

        $value = $this->createMock(ValueInterface::class);
        $subject = new Method($name, $visibility, $type, $description, $value);

        $parameters = $this->createMock(VariableInterface::class);
        $subject->setParameters($parameters);
        $this->assertEquals([$parameters], $subject->getParameters());
        $this->assertEquals(false, $subject->isAbstract());
        $subject->setIsAbstract(true);
        $this->assertEquals(true, $subject->isAbstract());
        $methodContent = 'new Foo();';
        $subject->setMethodContent($methodContent);
        $this->assertEquals($methodContent, $subject->getMethodContent());
    }

    /**
     *
     * @covers ::__construct
     * @covers ::getContent
     *
     * @param Method $method
     * @param string $expected
     *
     * @return void
     *
     * @dataProvider outputDataProvider
     */
    public function testOutput(Method $method, string $expected): void
    {
        $this->assertEquals($expected, $method->getContent());
    }

    /**
     * @return array
     */
    public function outputDataProvider(): array
    {
        $method = new Method(
            'foo',
            'public',
            'string',
            'Description for a method.'
        );

        $method->setMethodContent('foo();' . PHP_EOL . 'return bar();');
        $method->setParameters(
            new Variable(
                'varName',
                'array',
                'Variable description.',
                new Value(['foo' => 'bar'])
            )
        );

        $methodTwo = new Method(
            'foo',
            'public',
            '',
            'Description for a method.'
        );

        $methodTwo->setIsAbstract(true);
        $methodTwo->setParameters(
            new Variable(
                'varName',
                '',
                'Variable description.',
                new Value(['foo' => 'bar'])
            )
        );

        return [
            [
                $method,
                '/**' . PHP_EOL .
                ' * Description for a method.' . PHP_EOL .
                ' * ' . PHP_EOL .
                ' * @param array $varName Variable description.' . PHP_EOL .
                ' * ' . PHP_EOL .
                ' * @return string' . PHP_EOL .
                ' */' . PHP_EOL .
                'public function foo(' . PHP_EOL .
                '    array $varName = array (' . PHP_EOL .
                '      \'foo\' => \'bar\',' . PHP_EOL .
                '    )' . PHP_EOL .
                '): string {' . PHP_EOL .
                '    foo();' . PHP_EOL .
                '    return bar();' . PHP_EOL .
                '}' . PHP_EOL . PHP_EOL
            ],
            [
                $methodTwo,
                '/**' . PHP_EOL .
                ' * Description for a method.' . PHP_EOL .
                ' * ' . PHP_EOL .
                ' * @param mixed $varName Variable description.' . PHP_EOL .
                ' * ' . PHP_EOL .
                ' * @return mixed' . PHP_EOL .
                ' */' . PHP_EOL .
                'public function foo(' . PHP_EOL .
                '    $varName = array (' . PHP_EOL .
                '      \'foo\' => \'bar\',' . PHP_EOL .
                '    )' . PHP_EOL .
                ');' . PHP_EOL . PHP_EOL
            ]
        ];
    }
}
