<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

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
        return new self($string);
    }
}
