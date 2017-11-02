<?php
namespace Aheenam\Mozhi\Exceptions;

use Throwable;

class TemplateNotFoundException extends \Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}