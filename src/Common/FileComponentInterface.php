<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common;

interface FileComponentInterface
{
    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string;
}
