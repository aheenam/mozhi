<?php

namespace Aheenam\Mozhi;

use League\CommonMark\CommonMarkConverter;

class MarkdownParser
{
    public function __construct()
    {
        $this->converter = new CommonMarkConverter();
    }

    public function parse(string $markdown) : string
    {
        return $this->converter->convertToHtml($markdown);
    }
}
