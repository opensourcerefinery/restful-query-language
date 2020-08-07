<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Types\InvalidTypeValue;
use PHPUnit\Framework\TestCase;

final class ParameterBagTest extends TestCase
{
    public function test_it_should_return_the_parameter(): void
    {
        $bag = ParameterBag::fromArray(['key' => 'value']);

        self::assertTrue($bag->has('key'));
        self::assertSame('value', $bag->get('key')->toString());
    }

    public function test_it_should_throw_exception_when_invalid_parameter(): void
    {
        $bag = ParameterBag::emptyBag();
        self::assertFalse($bag->has('key'));

        $this->expectException(ParameterNotFound::class);
        $this->expectExceptionMessage('Parameter "key" was not found in the bag.');
        $bag->get('key');
    }

    public function test_it_should_allow_array_parameter_with_string(): void
    {
        $bag = ParameterBag::fromArray(['item' => ['key' => 'value']]);
        self::assertTrue($bag->has('item'));
        self::assertTrue($bag->has('item.key'));
        self::assertSame('value', $bag->get('item.key')->toString());
    }

    public function test_it_should_allow_array_parameter_with_int(): void
    {
        $bag = ParameterBag::fromArray(['item' => ['key' => 123]]);
        self::assertTrue($bag->has('item'));
        self::assertTrue($bag->has('item.key'));
        self::assertSame(123, $bag->get('item.key')->toInt());
    }

    public function test_it_should_not_allow_object_as_value(): void
    {
        $this->expectException(InvalidTypeValue::class);
        $this->expectExceptionMessage('Value of type "object" is not supported.');
        ParameterBag::fromArray(['item' => (object) ['key' => 123]]);
    }

    public function test_it_should_allow_float_value(): void
    {
        $bag = ParameterBag::fromArray(['float' => 12.34, 'float-str' => '12.34', 'int-float' => 1.0]);

        self::assertSame(12, $bag->get('float')->toInt());
        self::assertSame(12, $bag->get('float-str')->toInt());
        self::assertSame(1, $bag->get('int-float')->toInt());
        self::assertSame('12.34', $bag->get('float')->toString());
        self::assertSame('12.34', $bag->get('float-str')->toString());
        self::assertSame('1', $bag->get('int-float')->toString());
    }
}
