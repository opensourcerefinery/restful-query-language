<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use OpenSourceRefinery\Component\QueryLanguage\Types\Values\EmptyValue;
use Webmozart\Assert\Assert;

final class FloatValue implements TypeValue
{
    /**
     * @var float
     */
    private $value;

    private function __construct(float $value)
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
        return (string) $this->value;
    }

    public function toInt(): int
    {
        return (int) $this->value;
    }

    public static function fromInt(int $value): TypeValue
    {
        return self::fromFloat($value);
    }

    public static function fromMixed($value): TypeValue
    {
        if (
            (! \is_numeric($value) && \is_string($value)) && empty($value)
            || \is_null($value)
        ) {
            return new EmptyValue();
        }

        Assert::numeric($value, 'Value was expected to be a numeric. Got: "%s".');
        return self::fromFloat((float) $value);
    }

    public static function fromFloat(float $value): TypeValue
    {
        return new self($value);
    }
}
