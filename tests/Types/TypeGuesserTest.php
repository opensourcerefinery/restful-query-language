<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class TypeGuesserTest extends TestCase
{
    public function test_should_guess_int(): void
    {
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess(0));
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess(1));
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess(2));
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess('0'));
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess('1'));
        $this->assertInstanceOf(IntegerValue::class, TypeGuesser::guess('2'));
    }

    public function test_should_guess_float(): void
    {
        $this->assertInstanceOf(FloatValue::class, TypeGuesser::guess(1.0));
        $this->assertInstanceOf(FloatValue::class, TypeGuesser::guess(1.1));
        $this->assertInstanceOf(FloatValue::class, TypeGuesser::guess('1.0'));
        $this->assertInstanceOf(FloatValue::class, TypeGuesser::guess('1.1'));
    }

    public function test_should_guess_string(): void
    {
        $this->assertInstanceOf(StringValue::class, TypeGuesser::guess('something'));
    }
}
