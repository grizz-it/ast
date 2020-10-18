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
     * @covers ::setName
     * @covers ::getDescription
     * @covers ::setDescription
     * @covers ::getType
     * @covers ::setType
     * @covers ::getValue
     * @covers ::setValue
     * @covers ::getContent
     * @covers ::isVariadic
     * @covers ::setIsVariadic
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
        $this->assertEquals(false, $subject->isVariadic());

        $this->assertEquals(
            'string $foo = \'my-value\'',
            $subject->getContent()
        );

        $newValue = $this->createMock(ValueInterface::class);
        $subject->setName('bar');
        $subject->setDescription('Another description.');
        $subject->setType('int');
        $subject->setValue($newValue);
        $subject->setIsVariadic(true);

        $this->assertEquals('bar', $subject->getName());
        $this->assertEquals('Another description.', $subject->getDescription());
        $this->assertEquals('int', $subject->getType());
        $this->assertEquals($newValue, $subject->getValue());
        $this->assertEquals(true, $subject->isVariadic());
        $this->assertEquals(
            'int ...$bar',
            $subject->getContent()
        );
    }
}
