<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

use GrizzIt\Ast\Common\FileComponentInterface;

interface DefinitionInterface extends FileComponentInterface
{
    /**
     * Retrieves the name of the definition.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Retrieves the namespace of the definition.
     *
     * @return string
     */
    public function getNamespace(): string;

    /**
     * Retrieves what the definition extends.
     *
     * @return string
     */
    public function getExtends(): string;

    /**
     * Retrieves the constants for the definition.
     *
     * @return PropertyInterface[]
     */
    public function getConstants(): array;

    /**
     * Sets the constants for the definition.
     *
     * @param PropertyInterface ...$constants
     *
     * @return void
     */
    public function setConstants(PropertyInterface ...$constants): void;

    /**
     * Retrieves the methods for the definition.
     *
     * @return MethodInterface[]
     */
    public function getMethods(): array;

    /**
     * Sets the methods for the definition.
     *
     * @param MethodInterface ...$methods
     *
     * @return void
     */
    public function setMethods(MethodInterface ...$methods): void;

    /**
     * Retrieves the use statements for the definition.
     *
     * @return ReferenceInterface[]
     */
    public function getUses(): array;

    /**
     * Sets the use statements for the definition.
     *
     * @param ReferenceInterface ...$methods
     *
     * @return void
     */
    public function setUses(ReferenceInterface ...$uses): void;
}
