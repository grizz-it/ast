<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Variable;

use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Common\Php\VariableInterface;

class Variable implements VariableInterface
{
    /**
     * Contains the name of the variable.
     *
     * @var string
     */
    private $name;

    /**
     * Contains the type of the variable.
     *
     * @var string
     */
    private $type;

    /**
     * Contains the description of the variable.
     *
     * @var string
     */
    private $description;

    /**
     * Contains the value of the variable.
     *
     * @var ValueInterface|null
     */
    private $value;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $type
     * @param string $description
     * @param ValueInterface $value
     */
    public function __construct(
        string $name,
        string $type = '',
        string $description = '',
        ValueInterface $value = null
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * Retrieves the name of the property.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the property.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Retrieves the description of the property.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the description of the property.
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Retrieves the type of the property.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the type of the property.
     *
     * @param string $type
     *
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Retrieves the value of the variable.
     *
     * @return ValueInterface|null
     */
    public function getValue(): ?ValueInterface
    {
        return $this->value;
    }

    /**
     * Set the value of the variable.
     *
     * @param ValueInterface|null $value
     *
     * @return void
     */
    public function setValue(?ValueInterface $value): void
    {
        $this->value = $value;
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        return ($this->type !== '' ? $this->type . ' ' : '') .
            '$' .
            $this->name .
            ($this->value !== null ? ' = ' . $this->value->getContent() : '');
    }
}
