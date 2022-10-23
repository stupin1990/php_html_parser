<?php

namespace Src\Services;

class Display
{
    public static function printTagsTable($arr = []) : void
    {
        $sizes_ar = array_map(function($item) {
            return strlen((string)$item);
        }, array_keys($arr));
        $width = max($sizes_ar);

        $mask0 = " _%'_{$width}s_ _%-'_6s_ \n";
        $mask1 = "| %{$width}s | %-6s |\n";
        $mask2 = "|_%'_{$width}s_|_%-'_6s_|\n";
        printf($mask0, '', '');
        printf($mask1, 'Tag', 'Amount');
        printf($mask2, '', '');
        foreach($arr as $k => $v) {
            printf($mask1, $k, $v);
        }
        printf($mask2, '', '');
    }
}