<?php

namespace Aheenam\Mozhi\Documents;

interface Document
{
    public function getRawContent(): string;

    public function getHtmlContent(): string;

    public function getMetaData(): array;

    public function getTemplateName(): string;
}