<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface QueryParameter
{
    public function acceptParameterVisitor(ParameterVisitor $visitor): void;

    public function apply(QueryingPlatform $platform): void;
}
