<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

interface PropertyInterface extends VariableInterface
{
    /**
     * Retrieves the visibility of the property.
     *
     * @return string
     */
    public function getVisibility(): string;

    /**
     * Set the visibility of the property.
     *
     * @param string $visibility
     *
     * @return void
     */
    public function setVisibility(string $visibility): void;

    /**
     * Sets whether the property is static.
     *
     * @param bool $isStatic
     *
     * @return void
     */
    public function setIsStatic(bool $isStatic): void;

    /**
     * Determines whether the property is static.
     *
     * @return bool
     */
    public function isStatic(): bool;
}
