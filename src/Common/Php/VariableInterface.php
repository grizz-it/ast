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
     * Retrieves the name of the property.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Retrieves the description of the property.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Retrieves the type of the property.
     *
     * @return string
     */
    public function getType(): string;
}
