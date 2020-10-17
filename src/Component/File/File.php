<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\File;

use GrizzIt\Ast\Common\FileInterface;
use GrizzIt\Ast\Common\FileComponentInterface;

class File implements FileInterface
{
    /**
     * Contains all added file components.
     *
     * @var FileComponentInterface[]
     */
    private $components = [];

    /**
     * Contains the file name.
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
     * Contains the file name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Contains the file content.
     *
     * @return string
     */
    public function getContent(): string
    {
        $content = '';
        foreach ($this->components as $component) {
            $content .= $component->getContent();
        }

        return $content;
    }

    /**
     * Adds a component to the file.
     *
     * @param FileComponentInterface $fileComponent
     *
     * @return void
     */
    public function addComponent(
        FileComponentInterface $fileComponent
    ): void {
        $this->components[] = $fileComponent;
    }
}
