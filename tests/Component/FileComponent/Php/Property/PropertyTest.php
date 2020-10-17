<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Property;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Property;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Property\Property
 */
class PropertyTest extends TestCase
{
    /**
     * @covers ::getVisibility
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = 'foo';
        $visibility = 'private';
        $type = '';
        $description = 'Bar Baz.';
        $valueContent = '\'foo\'';
        $value = $this->createMock(ValueInterface::class);
        $value->expects(static::once())
            ->method('getContent')
            ->willReturn($valueContent);
        $subject = new Property($name, $visibility, $type, $description, $value);

        $this->assertEquals('private', $subject->getVisibility());
        $this->assertEquals(
            '/**' . PHP_EOL .
            ' * ' . $description . PHP_EOL .
            ' * ' . PHP_EOL .
            ' * @var mixed' . PHP_EOL .
            ' */' . PHP_EOL .
            $visibility . ' $' . $name . ' = ' . $valueContent . ';' . PHP_EOL .
            PHP_EOL,
            $subject->getContent()
        );
    }
}
