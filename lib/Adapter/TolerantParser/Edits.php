<?php

namespace Phpactor\CodeBuilder\Adapter\TolerantParser;

use Phpactor\CodeBuilder\Domain\TextEdits;
use Phpactor\CodeBuilder\Util\TextFormat;
use Phpactor\CodeBuilder\Domain\TextEdit;

class Edits
{
    private $edits = [];

    /**
     * @var TextFormat
     */
    private $format;

    public function __construct(TextFormat $format = null)
    {
        $this->format = $format ?: new TextFormat();
        ;
    }

    public function remove($node)
    {
        $this->edits[] = new TextEdit($node->getFullStart(), $node->getFullWidth(), '');
    }

    public function before($node, string $text)
    {
        $this->edits[] = new TextEdit($node->getStart(), 0, $text);
    }

    public function after($node, string $text)
    {
        $this->edits[] = new TextEdit($node->getEndPosition(), 0, $text);
    }

    public function replace($node, string $text)
    {
        $this->edits[] = new TextEdit($node->getFullStart(), $node->getFullWidth(), $text);
    }

    public function apply(string $code): string
    {
        return trim(TextEdit::applyEdits($this->edits, $code));
    }

    public function textEdits(): TextEdits
    {
        return TextEdits::fromTextEdits($this->edits);
    }

    public function add(TextEdit $textEdit)
    {
        $this->edits[] = $textEdit;
    }

    public function indent(string $string, int $level): string
    {
        return $this->format->indent($string, $level);
    }
}
