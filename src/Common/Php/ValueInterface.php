<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Common\Php;

use GrizzIt\Ast\Common\FileComponentInterface;

interface ValueInterface extends FileComponentInterface
{
    /**
     * Retrieves the value.
     *
     * @return mixed
     */
    public function getValue();
}
