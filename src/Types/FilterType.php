<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

interface FilterType
{
    /**
     * Whether the filter is allowed to be marked mandatory.
     *
     * @return bool
     */
    public function allowsRequired(): bool;

    /**
     * Whether the filter is allowed to be marked as default with the $value.
     *
     * @param TypeValue $value
     * @return bool
     */
    public function allowsDefaultValue(TypeValue $value): bool;
}
