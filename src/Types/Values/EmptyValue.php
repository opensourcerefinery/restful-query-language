<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types\Values;

use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;

final class EmptyValue implements TypeValue
{
    public function isEmpty(): bool
    {
        return true;
    }

    public function equalsTo(TypeValue $value): bool
    {
        return $value->isEmpty();
    }

    public function toString(): string
    {
        return '';
    }

    public function toInt(): int
    {
        return 0;
    }
}
