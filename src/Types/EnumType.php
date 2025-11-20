<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

final class EnumType implements FilterType
{
    /**
     * @var TypeValue[]
     */
    private $allowedValues;

    public function __construct(TypeValue $first, TypeValue ...$others)
    {
        $this->allowedValues = \array_merge([$first], $others);
    }

    public function allowsRequired(): bool
    {
        return true;
    }

    public function allowsDefaultValue(TypeValue $value): bool
    {
        return $this->allowsValue($value);
    }

    private function allowsValue(TypeValue $value): bool
    {
        foreach ($this->allowedValues as $allowedValue) {
            if ($allowedValue->equalsTo($value)) {
                return true;
            }
        }

        return false;
    }
}
