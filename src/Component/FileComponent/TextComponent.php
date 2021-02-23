<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent;

use GrizzIt\Ast\Common\FileComponentInterface;

class TextComponent implements FileComponentInterface
{
    /**
     * Contains the content of the file component.
     *
     * @var string
     */
    private string $content;

    /**
     * Constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
