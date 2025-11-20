<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use OpenSourceRefinery\Component\QueryLanguage\Types\Values\EmptyValue;

final class StringValue implements TypeValue
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function equalsTo(TypeValue $value): bool
    {
        return $value->toString() === $this->toString();
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function toInt(): int
    {
        return IntegerValue::fromString($this->value)->toInt();
    }

    public static function fromString(string $string): TypeValue
    {
        if (\mb_strlen($string) === 0) {
            return self::emptyString();
        }

        return new self($string);
    }

    public static function emptyString(): TypeValue
    {
        return new EmptyValue();
    }
}
