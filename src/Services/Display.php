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

        $mask = "| %{$width}s | %-6s |\n";
        printf($mask, 'Tag', 'Amount');
        printf($mask, '', '');
        foreach($arr as $k => $v) {
            printf($mask, $k, $v);
        }
    }
}