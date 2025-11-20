<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class FloatValueTest extends TestCase
{
    public function test_it_should_be_built_from_mixed(): void
    {
        self::assertSame(12, FloatValue::fromMixed('12')->toInt());
        self::assertSame(12, FloatValue::fromMixed('12.34')->toInt());
        self::assertSame('12', FloatValue::fromMixed('12')->toString());
        self::assertSame('12.34', FloatValue::fromMixed('12.34')->toString());
    }

    public function test_it_should_be_built_from_int(): void
    {
        self::assertSame(12, FloatValue::fromInt(12)->toInt());
    }

    public function test_it_should_be_built_from_float(): void
    {
        self::assertSame(12, FloatValue::fromFloat(12.34)->toInt());
        self::assertSame('12.34', FloatValue::fromFloat(12.34)->toString());
    }

    public function test_it_should_throw_exception_when_not_numeric(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value was expected to be a numeric. Got: "string".');
        FloatValue::fromMixed('string');
    }

    public function test_empty_string_should_return_empty_value(): void
    {
        self::assertTrue(FloatValue::fromMixed('')->isEmpty());
        self::assertTrue(FloatValue::fromMixed(null)->isEmpty());
    }

    public function test_zero_should_not_be_considered_empty(): void
    {
        self::assertFalse(FloatValue::fromMixed(0)->isEmpty());
        self::assertFalse(FloatValue::fromMixed(0.0)->isEmpty());
        self::assertFalse(FloatValue::fromMixed('0')->isEmpty());
        self::assertFalse(FloatValue::fromMixed('0.0')->isEmpty());
    }
}
