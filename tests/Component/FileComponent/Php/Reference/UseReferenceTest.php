<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Reference;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\FileComponent\Php\Reference\UseReference;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Reference\UseReference
 */
class UseReferenceTest extends TestCase
{
    /**
     * @covers ::getName
     * @covers ::setName
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = '\\Foo\\Bar\\Baz';
        $subject = new UseReference($name);

        $this->assertEquals($name, $subject->getName());
        $this->assertEquals(
            'use ' . $name . ';' . PHP_EOL,
            $subject->getContent()
        );

        $subject->setName('foo');
        $this->assertEquals('foo', $subject->getName());

        $this->assertEquals(
            'use foo;' . PHP_EOL,
            $subject->getContent()
        );
    }
}
