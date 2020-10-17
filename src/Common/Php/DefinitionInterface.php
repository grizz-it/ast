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
     * Set the name of the definition.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Retrieves the namespace of the definition.
     *
     * @return string
     */
    public function getNamespace(): string;

    /**
     * Set the namespace of the definition.
     *
     * @param string $namespace
     *
     * @return void
     */
    public function setNamespace(string $namespace): void;

    /**
     * Retrieves what the definition extends.
     *
     * @return string
     */
    public function getExtends(): string;

        /**
     * Sets what the definition extends.
     *
     * @param string $extends
     *
     * @return void
     */
    public function setExtends(string $extends): void;

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
