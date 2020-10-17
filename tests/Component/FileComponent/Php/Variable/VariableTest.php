<?php

namespace GrizzIt\Ast\Tests\Component\FileComponent\Php\Variable;

use PHPUnit\Framework\TestCase;
use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Component\FileComponent\Php\Variable\Variable;

/**
 * @coversDefaultClass \GrizzIt\Ast\Component\FileComponent\Php\Variable\Variable
 */
class VariableTest extends TestCase
{
    /**
     * @covers ::getName
     * @covers ::getDescription
     * @covers ::getType
     * @covers ::getValue
     * @covers ::getContent
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $name = 'foo';
        $type = 'string';
        $description = 'Bar';
        $value = $this->createMock(ValueInterface::class);
        $value->expects(static::once())
            ->method('getContent')
            ->willReturn('\'my-value\'');

        $subject = new Variable($name, $type, $description, $value);

        $this->assertEquals($name, $subject->getName());
        $this->assertEquals($description, $subject->getDescription());
        $this->assertEquals($type, $subject->getType());
        $this->assertEquals($value, $subject->getValue());
        $this->assertEquals(
            'string $foo = \'my-value\'',
            $subject->getContent()
        );
    }
}
