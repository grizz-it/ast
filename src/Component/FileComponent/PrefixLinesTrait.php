<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent;

trait PrefixLinesTrait
{
    /**
     * Converts components to their textual representation.
     *
     * @param FileComponentInterface ...$components
     *
     * @return string
     */
    private function prefixLines(
        string $prefix,
        string $lines
    ): string {
        return $prefix . preg_replace('/(\\n)/', '$1' . $prefix, $lines);
    }
}
