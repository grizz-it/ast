<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

use GrizzIt\Ast\Common\FileComponentInterface;

interface VariableInterface extends FileComponentInterface
{
    /**
     * Retrieves the value of the variable.
     *
     * @return ValueInterface|null
     */
    public function getValue(): ?ValueInterface;

    /**
     * Set the value of the variable.
     *
     * @param ValueInterface|null $value
     *
     * @return void
     */
    public function setValue(?ValueInterface $value): void;

    /**
     * Retrieves the name of the property.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set the name of the property.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Retrieves the description of the property.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set the description of the property.
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description): void;

    /**
     * Retrieves the type of the property.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Set the type of the property.
     *
     * @param string $type
     *
     * @return void
     */
    public function setType(string $type): void;
}
