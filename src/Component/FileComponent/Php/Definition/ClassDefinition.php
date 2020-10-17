<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Definition;

use GrizzIt\Ast\Common\Php\PropertyInterface;
use GrizzIt\Ast\Common\Php\ReferenceInterface;
use GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait;
use GrizzIt\Ast\Component\FileComponent\ConstructComponentArrayTrait;

class ClassDefinition extends AbstractDefinition
{
    use ConstructComponentArrayTrait;
    use PrefixLinesTrait;

    /**
     * Determines whether the class is abstract.
     *
     * @var bool
     */
    private $isAbstract = false;

    /**
     * Contains the implementing interfaces.
     *
     * @var string[]
     */
    private $implements = [];

    /**
     * Contains the traits for the definition.
     *
     * @var ReferenceInterface[]
     */
    private $traits = [];

    /**
     * Contains the properties of the definition.
     *
     * @var PropertyInterface[]
     */
    private $properties = [];

    /**
     * Determines wether the class should be rendered as a trait.
     *
     * @var bool
     */
    private $isTrait = false;

    /**
     * Determines whether the class is final.
     *
     * @var bool
     */
    private $isFinal = false;

    /**
     * Sets the class to be abstract.
     *
     * @param bool $abstract
     *
     * @return void
     */
    public function setAbstract(bool $abstract): void
    {
        $this->isAbstract = $abstract;
    }

    /**
     * Checks whether the class is abstract.
     *
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * Sets whether the class is final.
     *
     * @param bool $isFinal
     *
     * @return void
     */
    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }

    /**
     * Determines whether the class is final.
     *
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * Sets the implementing interfaces for the class definition.
     *
     * @param string ...$implements
     *
     * @return void
     */
    public function setImplements(string ...$implements): void
    {
        $this->implements = $implements;
    }

    /**
     * Retrieves the interfaces for the class.
     *
     * @return string[]
     */
    public function getImplements(): array
    {
        return $this->implements;
    }

    /**
     * Sets the class to become a trait.
     *
     * @param bool $isTrait
     *
     * @return void
     */
    public function setIsTrait(bool $isTrait): void
    {
        $this->isTrait = $isTrait;
    }

    /**
     * Checks wether the class is setup to be a trait.
     *
     * @return bool
     */
    public function isTrait(): bool
    {
        return $this->isTrait;
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        $class = parent::getContent();

        $classPrefix = 'trait ';

        if (!$this->isTrait) {
            $classPrefix = (
                $this->isAbstract ?
                'abstract ' :
                ($this->isFinal ? 'final ' : '')
            ) . 'class ';
        }

        $class .= $classPrefix . $this->getName();

        $extends = $this->getExtends();
        if ($extends !== '') {
            $class .= ' extends ' . $extends;
        }

        if (count($this->implements) > 0) {
            $class .= ' implements ' . implode(', ', $this->implements);
        }

        $traits = $this->constructComponents(...$this->getTraits());
        return $class .
        PHP_EOL .
        '{' .
        PHP_EOL .
        $this->prefixLines(
            '    ',
            rtrim(
                ($traits !== '' ? $traits . PHP_EOL : '') .
                $this->constructComponents(...$this->getConstants()) .
                $this->constructComponents(...$this->getProperties()) .
                $this->constructComponents(...$this->getMethods()),
                PHP_EOL
            )
        ) . PHP_EOL . '}' . PHP_EOL;
    }

    /**
     * Retrieves the traits for the definition.
     *
     * @return ReferenceInterface[]
     */
    public function getTraits(): array
    {
        return $this->traits;
    }

    /**
     * Sets the traits for the definition.
     *
     * @param ReferenceInterface ...$traits
     *
     * @return void
     */
    public function setTraits(ReferenceInterface ...$traits): void
    {
        $this->traits = $traits;
    }

    /**
     * Retrieves the properties for the definition.
     *
     * @return PropertyInterface[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Sets the properties for the definition.
     *
     * @param PropertyInterface ...$properties
     *
     * @return void
     */
    public function setProperties(PropertyInterface ...$properties): void
    {
        $this->properties = $properties;
    }
}
