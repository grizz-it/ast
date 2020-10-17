<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\FileComponent\TextComponent;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\TextComponent
 */
class TextComponentTest extends TestCase
{
    /**
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $content = 'foo';
        $subject = new TextComponent($content);

        $this->assertEquals('foo', $subject->getContent());
    }
}
