<?php declare(strict_types=1);

namespace PresProg\PasswordSuggestion;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PasswordSuggestionBundle extends Bundle
{
    public function getPath()
    {
        return \dirname(__DIR__);
    }
}
