<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class StringValueTest extends TestCase
{
    public function test_it_should_return_the_string_representation(): void
    {
        self::assertSame('val', StringValue::fromString('val')->toString());
        self::assertSame('213', StringValue::fromString('213')->toString());
    }

    public function test_it_should_return_the_int_representation_when_numeric(): void
    {
        self::assertSame('123', StringValue::fromString('123')->toString());
        self::assertSame('213', StringValue::fromString('213')->toString());
    }

    public function test_it_should_throw_exception_when_conversion_to_int_on_non_numeric(): void
    {
        $this->expectException(InvalidTypeValue::class);
        $this->expectExceptionMessage('Value "invalid" was expected to be integer, but is not.');
        StringValue::fromString('invalid')->toInt();
    }
}
