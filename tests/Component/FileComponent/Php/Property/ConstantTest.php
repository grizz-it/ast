<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Property;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Constant;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Property\Constant
 */
class ConstantTest extends TestCase
{
    /**
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = 'FOO';
        $visibility = 'public';
        $type = '';
        $description = 'A public constant.';
        $valueContent = '\'foo\'';
        $value = $this->createMock(ValueInterface::class);
        $value->expects(static::once())
            ->method('getContent')
            ->willReturn($valueContent);

        $subject = new Constant(
            $name,
            $visibility,
            $type,
            $description,
            $value
        );

        $this->assertEquals(
            '/**' . PHP_EOL .
            ' * ' . $description . PHP_EOL .
            ' */' . PHP_EOL .
            $visibility . ' const ' . $name . ' = ' . $valueContent . ';' . PHP_EOL .
            PHP_EOL,
            $subject->getContent()
        );
    }
}
