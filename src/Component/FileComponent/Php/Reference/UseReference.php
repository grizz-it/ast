<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Reference;

use GrizzIt\Ast\Common\Php\ReferenceInterface;

class UseReference implements ReferenceInterface
{
    /**
     * Contains the name of the reference.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Retrieves the name of the reference.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        return 'use ' . $this->getName() . ';' . PHP_EOL;
    }
}
