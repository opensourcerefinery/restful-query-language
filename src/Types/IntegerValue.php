<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

final class IntegerValue implements TypeValue
{
    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    /**
     * @param int|string $value
     * @return TypeValue
     */
    public static function fromNumeric($value): TypeValue
    {
        if (\is_string($value)) {
            return self::fromString($value);
        }

        return self::fromInt($value);
    }

    public static function fromInt(int $value): TypeValue
    {
        return new self($value);
    }

    public static function fromString(string $value): TypeValue
    {
        if (! \is_numeric($value)) {
            throw new InvalidTypeValue(\sprintf('Value "%s" was expected to be integer, but is not.', $value));
        }

        return new self((int) $value);
    }
}
