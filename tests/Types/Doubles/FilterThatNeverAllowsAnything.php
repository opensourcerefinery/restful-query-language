<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types\Doubles;

use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;

final class FilterThatNeverAllowsAnything implements FilterType
{
    public function allowsRequired(): bool
    {
        return false;
    }

    public function allowsDefaultValue($value): bool
    {
        return false;
    }
}
