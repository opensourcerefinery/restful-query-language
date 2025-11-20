<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

interface TypeValue
{
    /**
     * Whether the value is considered empty. Empty value are null and empty string. Zero/fasle is not considered empty.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @param TypeValue $value
     * @return bool
     */
    public function equalsTo(TypeValue $value): bool;

    /**
     * @return string
     */
    public function toString(): string;

    /**
     * @return int
     */
    public function toInt(): int;
}
