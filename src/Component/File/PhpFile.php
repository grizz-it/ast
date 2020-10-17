<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\File;

use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;

class PhpFile extends File
{
    /**
     * Contains the header of the PHP file.
     *
     * @var DocBlock
     */
    private $header;

    /**
     * Sets the header for the file.
     *
     * @param DocBlock $header
     *
     * @return void
     */
    public function setHeader(DocBlock $header): void
    {
        $this->header = $header;
    }

    /**
     * Contains the file content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return '<?php' . PHP_EOL . PHP_EOL .
            ($this->header !== null ? $this->header->getContent() : '') .
            PHP_EOL . parent::getContent();
    }
}
