<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\DocBlock
 */
class DocBlockTest extends TestCase
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
        $subject = new DocBlock($content);

        $this->assertEquals(
            '/**' . PHP_EOL . ' * ' . $content . PHP_EOL . ' */' . PHP_EOL,
            $subject->getContent()
        );
    }
}
