<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

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

    /**
     * @param int|float|string $value
     * @return TypeValue
     */
    public static function fromMixed($value): TypeValue
    {
        Assert::numeric($value, 'Value was expected to be a numeric. Got: "%s".');
        return self::fromFloat((float) $value);
    }

    public static function fromFloat(float $value): TypeValue
    {
        return new self($value);
    }
}
