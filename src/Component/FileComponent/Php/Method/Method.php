<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent\Php\Method;

use GrizzIt\Ast\Common\Php\MethodInterface;
use GrizzIt\Ast\Common\Php\PropertyInterface;
use GrizzIt\Ast\Common\Php\VariableInterface;
use GrizzIt\Ast\Component\FileComponent\Php\DocBlock;
use GrizzIt\Ast\Component\FileComponent\PrefixLinesTrait;
use GrizzIt\Ast\Component\FileComponent\Php\Property\Property;

class Method extends Property implements MethodInterface
{
    use PrefixLinesTrait;

    /**
     * Contains the parameters of the method.
     *
     * @var VariableInterface[]
     */
    private $parameters = [];

    /**
     * Determines whether the method is abstract or not.
     *
     * @var bool
     */
    private $isAbstract = false;

    /**
     * Contains the content of the method.
     *
     * @var string
     */
    private $content = '';

    /**
     * Determines whether the method is final.
     *
     * @var bool
     */
    private $isFinal = false;

    /**
     * Retrieves the parameters of the method.
     *
     * @return PropertyInterface[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Sets the parameters for the method.
     *
     * @param VariableInterface ...$parameters
     *
     * @return void
     */
    public function setParameters(VariableInterface ...$parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets whether the method is abstract.
     *
     * @param bool $isAbstract
     *
     * @return void
     */
    public function setIsAbstract(bool $isAbstract): void
    {
        $this->isAbstract = $isAbstract;
    }

    /**
     * Determines whether the method is abstract.
     *
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * Sets whether the method is final.
     *
     * @param bool $isFinal
     *
     * @return void
     */
    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }

    /**
     * Determines whether the method is final.
     *
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * Sets the methods' content.
     *
     * @param string $content
     *
     * @return void
     */
    public function setMethodContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Retrieves the content of the method.
     *
     * @return string
     */
    public function getMethodContent(): string
    {
        return $this->content;
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

        $parameterList = [];
        if (count($this->parameters) > 0) {
            foreach ($this->parameters as $parameter) {
                $type = $parameter->getType();
                if ($type === '') {
                    $type = 'mixed';
                }

                $description = $parameter->getDescription();
                if ($description !== '') {
                    $description = ' ' . $description;
                }

                $trimmedType = ltrim($type, '?');
                $docContent .= sprintf(
                    '@param %s %s%s',
                    ($type !== $trimmedType ? $trimmedType . '|null' : $type),
                    '$' . $parameter->getName(),
                    $description
                ) . PHP_EOL;

                $parameterList[] = $parameter->getContent();
            }

            $docContent .= PHP_EOL;
        }

        $type = $this->getType();
        if ($type === '') {
            $type = 'mixed';
        }

        $trimmedType = ltrim($type, '?');

        if ($this->getName() !== '__construct') {
            $docContent .= '@return ' .
            ($type !== $trimmedType ? $trimmedType . '|null' : $type);
        }

        $docContent = rtrim($docContent);

        return (new DocBlock($docContent))->getContent() .
            ($this->isFinal ? 'final ' : '') .
            $this->getVisibility() .
            ($this->isStatic() ? ' static' : '') .
            ' function ' . $this->getName() . '(' .
            (
                count($parameterList) > 0 ?
                PHP_EOL . $this->prefixLines(
                    '    ',
                    implode(',' . PHP_EOL, $parameterList)
                ) . PHP_EOL :
                ''
            ) . ')' .
            ($type !== 'mixed' ? ': ' . $type : '') .
            (
                $this->isAbstract() ?
                ';' :
                (count($parameterList) > 0 ? ' ' : PHP_EOL) . '{' . PHP_EOL .
                $this->prefixLines(
                    '    ',
                    $this->content
                ) . PHP_EOL . '}'
            ) . PHP_EOL . PHP_EOL;
    }
}
