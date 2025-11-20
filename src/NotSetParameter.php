<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

final class NotSetParameter implements QueryParameter
{
    public function acceptParameterVisitor(ParameterVisitor $visitor): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    public function apply(QueryingPlatform $platform): void
    {
    }
}
