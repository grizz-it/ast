<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Property;

use GrizzIt\Ast\Common\Php\ValueInterface;
use GrizzIt\Ast\Common\Php\PropertyInterface;
use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;
use GrizzIt\Ast\Component\FileComponent\Php\Variable\Variable;

class Property extends Variable implements PropertyInterface
{
    /**
     * Contains the visibility of the property.
     *
     * @var string
     */
    private $visibility;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $visibility
     * @param string $type
     * @param string $description
     * @param ValueInterface $value
     */
    public function __construct(
        string $name,
        string $visibility,
        string $type = '',
        string $description = '',
        ValueInterface $value = null
    ) {
        parent::__construct($name, $type, $description, $value);
        $this->visibility = $visibility;
    }

    /**
     * Retrieves the visibility of the property.
     *
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

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
            $docContent = $description . PHP_EOL . PHP_EOL;
        }

        $type = $this->getType();
        if ($type === '') {
            $type = 'mixed';
        }

        $docContent .= '@var ' . $type;
        $value = $this->getValue();
        return (new DocBlock($docContent))->getContent() .
            $this->visibility .
            ' $' .
            $this->getName() .
            (
                $value !== null ?
                ' = ' . $value->getContent() :
                ''
            ) .
            ';' . PHP_EOL . PHP_EOL;
    }
}
