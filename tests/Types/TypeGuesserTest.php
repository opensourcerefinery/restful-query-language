<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class TypeGuesserTest extends TestCase
{
    public function test_should_guess_int(): void
    {
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess(0));
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess(1));
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess(2));
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess('0'));
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess('1'));
        self::assertInstanceOf(IntegerValue::class, TypeGuesser::guess('2'));
    }

    public function test_should_guess_float(): void
    {
        self::assertInstanceOf(FloatValue::class, TypeGuesser::guess(1.0));
        self::assertInstanceOf(FloatValue::class, TypeGuesser::guess(1.1));
        self::assertInstanceOf(FloatValue::class, TypeGuesser::guess('1.0'));
        self::assertInstanceOf(FloatValue::class, TypeGuesser::guess('1.1'));
    }

    public function test_should_guess_string(): void
    {
        self::assertInstanceOf(StringValue::class, TypeGuesser::guess('something'));
    }
}
