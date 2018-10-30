<?php

namespace Aheenam\Mozhi\Documents;

interface Document
{
    public function getContent(): string;

    public function getMetaData(): array;

    public function getTemplateName(): string;
}