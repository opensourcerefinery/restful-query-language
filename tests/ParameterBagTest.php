<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Types\InvalidTypeValue;
use OpenSourceRefinery\Component\QueryLanguage\Types\StringValue;
use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;
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

    public function test_it_should_be_immutable_when_setting_a_value(): void
    {
        $original = ParameterBag::emptyBag();
        $withOne = $original->set('one', $this->createMock(TypeValue::class));
        $withThree = $withOne
            ->set('two', $this->createMock(TypeValue::class))
            ->set('three', $this->createMock(TypeValue::class));

        self::assertFalse($original->has('one'));
        self::assertFalse($withOne->has('two'));
        self::assertFalse($withOne->has('three'));

        self::assertTrue($withOne->has('one'));
        self::assertFalse($withOne->has('two'));
        self::assertFalse($withOne->has('three'));

        self::assertTrue($withThree->has('one'));
        self::assertTrue($withThree->has('two'));
        self::assertTrue($withThree->has('three'));
    }

    public function test_it_should_replace_value(): void
    {
        $bag = ParameterBag::fromArray(['one' => ['two' => ['three' => ['value']]]]);

        $replace = $bag->set('one', StringValue::fromString('value'));
        self::assertSame('value', $replace->get('one')->toString());
        self::assertFalse($replace->has('one.two'));
        self::assertFalse($replace->has('one.two.three'));

        $replace = $bag->set('one.two.three', StringValue::fromString('new'));
        self::assertTrue($replace->has('one'));
        self::assertTrue($replace->has('one.two'));
        self::assertSame('new', $replace->get('one.two.three')->toString());
    }

    public function test_it_should_return_the_value_of_node(): void
    {
        $bag = ParameterBag::fromArray(['one' => ['two' => ['three' => 'value']]]);
        self::assertSame('value', $bag->get('one.two.three')->toString());
        self::assertSame('{"three":"value"}', $bag->get('one.two')->toString());
        self::assertSame('{"two":{"three":"value"}}', $bag->get('one')->toString());
    }
}
