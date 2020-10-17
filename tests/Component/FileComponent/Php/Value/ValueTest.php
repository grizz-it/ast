<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Value;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\FileComponent\Php\Value\Value;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Value\Value
 */
class ValueTest extends TestCase
{
    /**
     * @covers ::getValue
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $value = 'foo';
        $expected = '\'foo\'';
        $subject = new Value($value);

        $this->assertEquals($value, $subject->getValue());
        $this->assertEquals($expected, $subject->getContent());
    }
}
