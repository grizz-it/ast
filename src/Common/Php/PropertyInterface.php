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
}
