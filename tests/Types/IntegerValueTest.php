<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class IntegerValueTest extends TestCase
{
    public function test_it_should_return_int_value(): void
    {
        self::assertSame(12, IntegerValue::fromInt(12)->toInt());
        self::assertSame(12, IntegerValue::fromString('12')->toInt());
    }

    public function test_it_should_return_string_value(): void
    {
        self::assertSame('12', IntegerValue::fromString('12')->toString());
        self::assertSame('12', IntegerValue::fromInt(12)->toString());
    }

    public function test_it_should_throw_exception_when_string_is_not_numeric(): void
    {
        $this->expectException(InvalidTypeValue::class);
        $this->expectExceptionMessage('Value "invalid" was expected to be integer, but is not.');
        IntegerValue::fromString('invalid');
    }
}
