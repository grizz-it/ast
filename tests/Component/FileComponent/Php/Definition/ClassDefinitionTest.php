<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Definition;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Common\Php\PropertyInterface;
use GrizzIt\Ast\Common\Php\ReferenceInterface;
use GrizzIt\Ast\Component\FileComponent\Php\Value\Value;
use GrizzIt\Ast\Component\FileComponent\Php\Method\Method;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Constant;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Property;
use GrizzIt\Ast\Component\FileComponent\Php\Reference\UseReference;
use GrizzIt\Ast\Component\FileComponent\Php\Definition\ClassDefinition;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Definition\ClassDefinition
 * @covers \GrizzIt\Ast\Component\FileComponent\Php\Definition\AbstractDefinition
 * @covers \GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait
 * @covers \GrizzIt\Ast\Component\FileComponent\ConstructComponentArrayTrait
 */
class ClassDefinitionTest extends TestCase
{
    /**
     * @covers ::setAbstract
     * @covers ::setImplements
     * @covers ::getImplements
     * @covers ::setIsTrait
     * @covers ::getTraits
     * @covers ::setTraits
     * @covers ::getProperties
     * @covers ::setProperties
     * @covers ::isAbstract
     * @covers ::isTrait
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $subject = new ClassDefinition('foo', 'bar', 'baz');

        $this->assertEquals(false, $subject->isAbstract());
        $subject->setAbstract(true);
        $this->assertEquals(true, $subject->isAbstract());

        $this->assertEquals(false, $subject->isTrait());
        $subject->setIsTrait(true);
        $this->assertEquals(true, $subject->isTrait());

        $property = $this->createMock(PropertyInterface::class);
        $subject->setProperties($property);
        $this->assertEquals([$property], $subject->getProperties());

        $subject->setImplements('foo', 'bar');
        $this->assertEquals(['foo', 'bar'], $subject->getImplements());

        $trait = $this->createMock(ReferenceInterface::class);
        $subject->setTraits($trait);
        $this->assertEquals([$trait], $subject->getTraits());
    }

    /**
     * @covers ::getContent
     * @covers ::__construct
     *
     * @param ClassDefinition $subject
     * @param string $expected
     *
     * @return void
     *
     * @dataProvider classProvider
     */
    public function testGetContent(
        ClassDefinition $subject,
        string $expected
    ): void {
        $this->assertEquals($expected, $subject->getContent());
    }

    /**
     * Provides test cases for classes.
     *
     * @return array
     */
    public function classProvider(): array
    {
        $class = new ClassDefinition('Baz', 'Foo\\Bar', 'Qux');
        $class->setImplements('Foo', 'Bar');
        $class->setTraits(new UseReference('Bar\\Baz\\Qux'));
        $class->setMethods(new Method(
            'foo',
            'public',
            'string',
            'Description for a method.'
        ));

        $class->setConstants(new Constant(
            'MY_CONSTANT',
            'public',
            '',
            'Constant description.',
            new Value('my-constant-value')
        ));

        $class->setProperties(
            new Property(
                'foo',
                'private',
                'string',
                'Some random property.'
            )
        );

        return [
            [
                new ClassDefinition('Foo'),
                'class Foo' . PHP_EOL .
                '{' . PHP_EOL .
                '    ' . PHP_EOL .
                '}' . PHP_EOL
            ],
            [
                new ClassDefinition('Baz', 'Foo\\Bar', 'Qux'),
                'namespace Foo\\Bar;' . PHP_EOL . PHP_EOL .
                'class Baz extends Qux' . PHP_EOL .
                '{' . PHP_EOL .
                '    ' . PHP_EOL .
                '}' . PHP_EOL
            ],
            [
                $class,
                'namespace Foo\\Bar;' . PHP_EOL . PHP_EOL .
                'class Baz extends Qux implements Foo, Bar' . PHP_EOL .
                '{' . PHP_EOL .
                '    use Bar\\Baz\\Qux;' . PHP_EOL .
                '    ' . PHP_EOL .
                '    /**' . PHP_EOL .
                '     * Constant description.' . PHP_EOL .
                '     */' . PHP_EOL .
                '    public const MY_CONSTANT = \'my-constant-value\';' . PHP_EOL .
                '    ' . PHP_EOL .
                '    /**' . PHP_EOL .
                '     * Some random property.' . PHP_EOL .
                '     * ' . PHP_EOL .
                '     * @var string' . PHP_EOL .
                '     */' . PHP_EOL .
                '    private $foo;' . PHP_EOL .
                '    ' . PHP_EOL .
                '    /**' . PHP_EOL .
                '     * Description for a method.' . PHP_EOL .
                '     * ' . PHP_EOL .
                '     * @return string' . PHP_EOL .
                '     */' . PHP_EOL .
                '    public function foo(): string' . PHP_EOL .
                '    {' . PHP_EOL .
                '        ' . PHP_EOL .
                '    }' . PHP_EOL .
                '}' . PHP_EOL
            ]
        ];
    }
}
