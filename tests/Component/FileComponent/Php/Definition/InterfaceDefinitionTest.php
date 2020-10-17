<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Definition;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\FileComponent\Php\Value\Value;
use GrizzIt\Ast\Component\FileComponent\Php\Method\Method;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Constant;
use GrizzIt\Ast\Component\FileComponent\Php\Reference\UseReference;
use GrizzIt\Ast\Component\FileComponent\Php\Definition\InterfaceDefinition;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Definition\InterfaceDefinition
 * @covers \GrizzIt\Ast\Component\FileComponent\Php\Definition\AbstractDefinition
 * @covers \GrizzIt\Ast\Component\FileComponent\ConstructComponentArrayTrait
 * @covers \GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait
 */
class InterfaceDefinitionTest extends TestCase
{
    /**
     * @covers ::getContent
     * @covers ::setMethods
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = 'Baz';
        $namespace = '\\Foo\\Bar';
        $extends = [
            '\\MyVendor\\MyPackage\\MyInterface',
            'MyOtherInterface'
        ];

        $subject = new InterfaceDefinition($name, $namespace, ...$extends);

        $subject->setMethods(new Method(
            'foo',
            'public',
            'string',
            'Description for a method.'
        ));

        $subject->setConstants(new Constant(
            'MY_CONSTANT',
            'public',
            '',
            'Constant description.',
            new Value('my-constant-value')
        ));

        $subject->setUses(new UseReference(
            '\\MyVendor\\MyPackage\\MyOtherInterface'
        ));

        $this->assertEquals($namespace, $subject->getNamespace());

        $this->assertEquals(
            'namespace \\Foo\\Bar;' . PHP_EOL . PHP_EOL .
            'use \\MyVendor\\MyPackage\\MyOtherInterface;' . PHP_EOL . PHP_EOL .
            'interface Baz extends \\MyVendor\\MyPackage\\MyInterface, MyOtherInterface' .
            PHP_EOL . '{' . PHP_EOL .
            '    /**' . PHP_EOL .
            '     * Constant description.' . PHP_EOL .
            '     */' . PHP_EOL .
            '    public const MY_CONSTANT = \'my-constant-value\';' . PHP_EOL .
            '    ' . PHP_EOL .
            '    /**' . PHP_EOL .
            '     * Description for a method.' . PHP_EOL .
            '     * ' . PHP_EOL .
            '     * @return string' . PHP_EOL .
            '     */' . PHP_EOL .
            '    public function foo(): string;' . PHP_EOL .
            '}' . PHP_EOL,
            $subject->getContent()
        );
    }
}
