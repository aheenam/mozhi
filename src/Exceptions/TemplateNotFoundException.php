<?php

namespace Aheenam\Mozhi\Exceptions;

class TemplateNotFoundException extends \RuntimeException
{
    public static function forTemplateInTheme(string $template, string $theme): self
    {
        return new self("Template [$template] was not found in theme [$theme]");
    }
}
