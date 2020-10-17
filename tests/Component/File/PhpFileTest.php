<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Tests\Component\File;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Component\File\PhpFile;
use GrizzIt\Ast\Common\FileComponentInterface;
use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\File\PhpFile
 */
class PhpFileTest extends TestCase
{
    /**
     * @covers ::getContent
     * @covers ::setHeader
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $docBlock = '/**' . PHP_EOL .
        ' * My docblock' . PHP_EOL .
        ' */';

        $content = 'myMethod();';

        $subject = new PhpFile('foo');

        $header = $this->createMock(DocBlock::class);
        $fileComponent = $this->createMock(FileComponentInterface::class);

        $fileComponent->expects(static::once())
            ->method('getContent')
            ->willReturn($content);

        $header->expects(static::once())
            ->method('getContent')
            ->willReturn($docBlock);

        $subject->setHeader($header);
        $subject->addComponent($fileComponent);
        $this->assertEquals(
            '<?php' . PHP_EOL . PHP_EOL .
            $docBlock . PHP_EOL . $content,
            $subject->getContent()
        );
    }
}
