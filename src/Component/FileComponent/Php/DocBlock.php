<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php;

use GrizzIt\Ast\Component\FileComponent\TextComponent;

class DocBlock extends TextComponent
{
    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        $content = parent::getContent();
        $header = '';
        if (strlen($content) > 0) {
            $headerLines = explode(PHP_EOL, $content);
            $header = '/**' . PHP_EOL;
            foreach ($headerLines as $headerLine) {
                $header .= ' * ' . $headerLine . PHP_EOL;
            }

            $header .= ' */' . PHP_EOL;
        }

        return $header;
    }
}
