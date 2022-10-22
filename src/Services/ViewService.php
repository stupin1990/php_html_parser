<?php

namespace HtmlParser;


class ViewService
{
    public static function printArKeysVals($arr = [], $show = 1) : string
    {
        $out = '';
        foreach($arr as $k => $v) {
            $out .= "$k: $v" . PHP_EOL;
        }

        if ($show) {
            echo $out;
        }

        return $out;
    }
}