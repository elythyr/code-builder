<?php

namespace Phpactor\CodeBuilder\Util;

final class TextUtil
{
    public static function lines(string $text): array
    {
        return preg_split("{(\r\n|\n|\r)}", $text);
    }

    public static function lineIndentation(string $line): string
    {
        if (!preg_match('{^([\t ]*)}', $line, $matches)) {
            return '';
        }

        return $matches[1];
    }

    public static function hasDocblock(string $line): bool
    {
        return (bool)preg_match('{^\s*\*}m', $line);
    }
}
