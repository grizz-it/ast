<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Value;

use GrizzIt\Ast\Common\Php\ValueInterface;

class Value implements ValueInterface
{
    /**
     * Contains the value.
     *
     * @var mixed
     */
    private $value;

    /**
     * Constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Retrieves the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        return var_export($this->value, true);
    }
}
