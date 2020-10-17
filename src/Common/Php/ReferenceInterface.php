<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

use GrizzIt\Ast\Common\FileComponentInterface;

interface ReferenceInterface extends FileComponentInterface
{
    /**
     * Retrieves the name of the reference.
     *
     * @return string
     */
    public function getName(): string;
}
