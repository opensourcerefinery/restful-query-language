<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types\Values;

use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;
use PHPUnit\Framework\TestCase;

final class EmptyValueTest extends TestCase
{
    /**
     * @var EmptyValue
     */
    private $value;

    protected function setUp(): void
    {
        $this->value = new EmptyValue();
    }

    public function test_it_should_be_empty(): void
    {
        self::assertTrue($this->value->isEmpty());
    }

    public function test_it_should_only_be_equals_when_empty(): void
    {
        self::assertTrue($this->value->equalsTo(new EmptyValue()));
        self::assertFalse($this->value->equalsTo($this->createMock(TypeValue::class)));
    }

    public function test_it_should_return_empty_string(): void
    {
        self::assertSame('', $this->value->toString());
    }

    public function test_it_should_return_empty_int(): void
    {
        self::assertSame(0, $this->value->toInt());
    }
}
