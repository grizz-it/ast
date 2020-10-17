<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

interface MethodInterface extends PropertyInterface
{
    /**
     * Retrieves the parameters of the method.
     *
     * @return PropertyInterface[]
     */
    public function getParameters(): array;

    /**
     * Sets the parameters for the method.
     *
     * @param VariableInterface ...$parameters
     *
     * @return void
     */
    public function setParameters(VariableInterface ...$parameters): void;

    /**
     * Sets whether the method is abstract.
     *
     * @param bool $isAbstract
     *
     * @return void
     */
    public function setIsAbstract(bool $isAbstract): void;

    /**
     * Determines whether the method is abstract.
     *
     * @return bool
     */
    public function isAbstract(): bool;

    /**
     * Sets the methods' content.
     *
     * @param string $content
     *
     * @return void
     */
    public function setMethodContent(string $content): void;

    /**
     * Retrieves the content of the method.
     *
     * @return string
     */
    public function getMethodContent(): string;
}
