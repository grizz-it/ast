<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Definition;

use GrizzIt\Ast\Common\Php\MethodInterface;
use GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait;
use GrizzIt\Ast\Component\FileComponent\ConstructComponentArrayTrait;

class InterfaceDefinition extends AbstractDefinition
{
    use ConstructComponentArrayTrait;
    use PrefixLinesTrait;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $namespace
     * @param string ...$extends
     */
    public function __construct(
        string $name,
        string $namespace,
        string ...$extends
    ) {
        parent::__construct($name, $namespace, implode(', ', $extends));
    }

    /**
     * Retrieves the content of the component.
     *
     * @return string
     */
    public function getContent(): string
    {
        $interface = parent::getContent() . 'interface ' . $this->getName();

        $extends = $this->getExtends();
        if ($extends !== '') {
            $interface .= ' extends ' . $extends;
        }

        return
            $interface .
            PHP_EOL .
            '{' .
            PHP_EOL .
            $this->prefixLines(
                '    ',
                rtrim(
                    $this->constructComponents(...$this->getConstants()) .
                    $this->constructComponents(...$this->getMethods())
                ),
                PHP_EOL
            ) . PHP_EOL . '}' . PHP_EOL;
    }

    /**
     * Sets the methods for the definition.
     *
     * @param MethodInterface ...$methods
     *
     * @return void
     */
    public function setMethods(MethodInterface ...$methods): void
    {
        foreach ($methods as $method) {
            $method->setIsAbstract(true);
        }

        parent::setMethods(...$methods);
    }
}
