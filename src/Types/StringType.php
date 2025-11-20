<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

final class StringType implements FilterType
{
    public function allowsRequired(): bool
    {
        return true;
    }

    public function allowsDefaultValue(TypeValue $value): bool
    {
        return true;
    }
}
