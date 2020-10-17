# GrizzIT AST - Create a PHP file

This package can be used in generators to create PHP files. This can especially
useful when e.g. a project uses automatically generated proxies to use plugins.

## Interfaces

Everything starts with a [FileInterface](../../src/Common/FileInterface.php)
type object. These file objects can have
[FileComponentInterface](../../src/Common/FileComponentInterface.php) type
objects injected into them to compose the file.

## PHP related objects

There are two types of definitions in this package:
- [ClassDefinition](../../src/Component/FileComponent/Php/Definition/ClassDefinition.php)
- [InterfaceDefinition](../../src/Component/FileComponent/Php/Definition/InterfaceDefinition.php)

The `InterfaceDefinition` is used for generating interfaces. The
`ClassDefinition` is a bit more versatile, because it can generate:
- Regular classes
- Abstract classes
- Traits

Methods are described by the
[Method](../../src/Component/FileComponent/Php/Method/Method.php) class.

There are two types of property classes:
- [Property](../../src/Component/FileComponent/Php/Property/Property.php),
Used to generate class properties.
- [Constant](../../src/Component/FileComponent/Php/Property/Constant.php),
Used to generate constants.

References are used for `use` statements. This is done with the
[UseReference](../../src/Component/FileComponent/Php/Reference/UseReference.php)
class.

Default values for methods and properties are described by the
[Value](../../src/Component/FileComponent/Php/Value/Value.php) class.

Variables and parameters are described by the
[Variable](../../src/Component/FileComponent/Php/Variable/Variable.php) class.

Documentation for files and methods can be added with the
[DocBlock](../../src/Component/FileComponent/Php/DocBlock.php) class.

## General components

All of these files use the base classes [File](../../src/Component/File/File.php)
for files, and [TextComponent](../../src/Component/FileComponent/TextComponent.php)
for file components.

# Generator example

A simple generated class would look like the following:

```PHP
<?php

use GrizzIt\Ast\Component\File\PhpFile;
use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;
use GrizzIt\Ast\Component\FileComponent\Php\Value\Value;
use GrizzIt\Ast\Component\FileComponent\Php\Method\Method;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Property;
use GrizzIt\Ast\Component\FileComponent\Php\Variable\Variable;
use GrizzIt\Ast\Component\FileComponent\Php\Definition\ClassDefinition;

// Set the filename on the object.
$file = new PhpFile('HelloWorld.php');

$file->setHeader(new DocBlock(
    'My file header.' .PHP_EOL .
    'This is a sample class.'
));

// Create the class definition.
$class = new ClassDefinition(
    'HelloWorld',
    'Foo\\Bar',
    'AbstractWorld'
);

// Add the class to the file.
$file->addComponent($class);

// Create a property.
$class->setProperties(new Property(
    'name',
    'private',
    'string',
    'The name of the greeted.'
));

// Create the constructor method.
$constructor = new Method(
    '__construct',
    'public',
    '',
    'Constructor.'
);

// Set a parameter for the constructor.
$constructor->setParameters(new Variable(
    'name',
    'string',
    'The name of the person.',
    new Value('World')
));

// Set the method content.
$constructor->setMethodContent(
    'parent::__construct();' . PHP_EOL .
    '$this->name = $name;'
);

// Create the greet method.
$greet = new Method('greet', 'public', 'string', 'Greet the configured person.');
$greet->setMethodContent(
    'echo sprintf(' . PHP_EOL .
    '    \'Hello, %s!\',' . PHP_EOL .
    '    $this->name' . PHP_EOL .
    ');'
);

$class->setMethods($constructor, $greet);

file_put_contents(__DIR__ . '/' . $file->getName(), $file->getContent());

```

# Generator result

The resulting file would be the following:

```PHP
<?php

/**
 * My file header.
 * This is a sample class.
 */

namespace Foo\Bar;

class HelloWorld extends AbstractWorld
{
    /**
     * The name of the greeted.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string $name The name of the person.
     */
    public function __construct(
        string $name = 'World'
    ) {
        parent::__construct();
        $this->name = $name;
    }

    /**
     * Greet the configured person.
     *
     * @return string
     */
    public function greet(): string
    {
        echo sprintf(
            'Hello, %s!',
            $this->name
        );
    }
}

```

## Further reading

[Back to usage index](index.md)
