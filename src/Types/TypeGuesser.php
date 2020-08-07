<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

final class TypeGuesser
{
    private function __construct()
    {
    }

    /**
     * @param mixed $value
     * @return TypeValue
     */
    public static function guess($value): TypeValue
    {
        if (\is_numeric($value)) {
            if (\is_float($value) || (\is_string($value) && \strpos($value, '.') !== false)) {
                return FloatValue::fromMixed($value);
            }

            return IntegerValue::fromNumeric($value);
        }

        if (\is_string($value)) {
            $value = StringValue::fromString($value);
        }

        if (! $value instanceof TypeValue) {
            throw new InvalidTypeValue(
                \sprintf('Value of type "%s" is not supported.', \gettype($value))
            );
        }

        return $value;
    }
}
