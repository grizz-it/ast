<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\File;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\File\File;
use GrizzIt\Ast\Common\FileComponentInterface;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\File\File
 */
class FileTest extends TestCase
{
    /**
     * @covers ::getName
     * @covers ::getContent
     * @covers ::addComponent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $expected = 'This is some content';
        $name = 'foo';
        $subject = new File($name);
        $fileComponent = $this->createMock(FileComponentInterface::class);

        $fileComponent->expects(static::once())
            ->method('getContent')
            ->willReturn($expected);

        $subject->addComponent($fileComponent);
        $this->assertEquals($name, $subject->getName());
        $this->assertEquals($expected, $subject->getContent());
    }
}
