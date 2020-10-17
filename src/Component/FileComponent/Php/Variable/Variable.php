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
     * Retrieves the description of the property.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
     * Retrieves the value of the variable.
     *
     * @return ValueInterface|null
     */
    public function getValue(): ?ValueInterface
    {
        return $this->value;
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
