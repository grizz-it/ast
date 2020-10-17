<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Definition;

use GrizzIt\Ast\Common\Php\MethodInterface;
use GrizzIt\Ast\Common\Php\PropertyInterface;
use GrizzIt\Ast\Common\Php\ReferenceInterface;
use GrizzIt\Ast\Common\Php\DefinitionInterface;
use GrizzIt\Ast\Component\FileComponent\ConstructComponentArrayTrait;

abstract class AbstractDefinition implements DefinitionInterface
{
    use ConstructComponentArrayTrait;

    /**
     * Contains the name of the definition.
     *
     * @var string
     */
    private $name;

    /**
     * Contains the namespace of the definition.
     *
     * @var string
     */
    private $namespace;

    /**
     * Contains the extends of the definition.
     *
     * @var string
     */
    private $extends;

    /**
     * Contains the methods of the definition.
     *
     * @var MethodInterface[]
     */
    private $methods = [];

    /**
     * Contains the constants of the definition.
     *
     * @var PropertyInterface[]
     */
    private $constants = [];

    /**
     * Contains the use statements of the definition.
     *
     * @var ReferenceInterface[]
     */
    private $uses = [];

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $namespace
     * @param string $extends
     */
    public function __construct(
        string $name,
        string $namespace = '',
        string $extends = ''
    ) {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->extends = $extends;
    }

    /**
     * Retrieves the name of the definition.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Retrieves the namespace of the definition.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Retrieves what the definition extends.
     *
     * @return string
     */
    public function getExtends(): string
    {
        return $this->extends;
    }

    /**
     * Retrieves the constants for the definition.
     *
     * @return PropertyInterface[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * Sets the constants for the definition.
     *
     * @param PropertyInterface ...$constants
     *
     * @return void
     */
    public function setConstants(PropertyInterface ...$constants): void
    {
        $this->constants = $constants;
    }

    /**
     * Retrieves the methods for the definition.
     *
     * @return MethodInterface[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Sets the methods for the definition.
     *
     * @param MethodInterface ...$methods
     *
     * @return void
     */
    public function setMethods(MethodInterface ...$methods): void
    {
        $this->methods = $methods;
    }

    /**
     * Retrieves the use statements for the definition.
     *
     * @return ReferenceInterface[]
     */
    public function getUses(): array
    {
        return $this->uses;
    }

    /**
     * Sets the use statements for the definition.
     *
     * @param ReferenceInterface ...$uses
     *
     * @return void
     */
    public function setUses(ReferenceInterface ...$uses): void
    {
        $this->uses = $uses;
    }

        /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        $uses = $this->constructComponents(...$this->getUses());
        return (
                $this->namespace !== '' ?
                'namespace ' . $this->namespace . ';' . PHP_EOL . PHP_EOL :
                ''
            ) . ($uses !== '' ? $uses . PHP_EOL : '');
    }
}
