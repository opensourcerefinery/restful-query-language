<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

final class NotSetParameter implements QueryParameter
{
    public function apply(QueryingPlatform $platform): void
    {
    }
}
