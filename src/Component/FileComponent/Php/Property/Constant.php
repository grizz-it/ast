<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Property;

use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;

class Constant extends Property
{
    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        $docContent = '';
        $description = $this->getDescription();
        if ($description !== '') {
            $docContent = (new DocBlock($description))->getContent();
        }

        $value = $this->getValue();
        return $docContent .
            $this->getVisibility() .
            ' const ' .
            $this->getName() .
            (
                $value !== null ?
                ' = ' . $value->getContent() :
                ''
            ) .
            ';' . PHP_EOL . PHP_EOL;
    }
}
