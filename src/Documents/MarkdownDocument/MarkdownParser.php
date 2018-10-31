<?php

namespace Aheenam\Mozhi\Documents\MarkdownDocument;

interface MarkdownParser
{
    public function parse(string $markdown): string;
}