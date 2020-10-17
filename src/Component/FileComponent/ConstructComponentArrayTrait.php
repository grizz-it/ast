<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Ast\Component\FileComponent;

use GrizzIt\Ast\Common\FileComponentInterface;

trait ConstructComponentArrayTrait
{
    /**
     * Converts components to their textual representation.
     *
     * @param FileComponentInterface ...$components
     *
     * @return string
     */
    private function constructComponents(
        FileComponentInterface ...$components
    ): string {
        $output = '';

        foreach ($components as $component) {
            $output .= $component->getContent();
        }

        return $output;
    }
}
