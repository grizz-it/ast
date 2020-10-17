<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common;

interface FileInterface
{
    /**
     * Contains the file name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Contains the file content.
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Adds a component to the file.
     *
     * @param FileComponentInterface $fileComponent
     *
     * @return void
     */
    public function addComponent(
        FileComponentInterface $fileComponent
    ): void;
}
