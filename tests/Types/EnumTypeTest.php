<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class EnumTypeTest extends TestCase
{
    public function test_should_allow_required(): void
    {
        $type = new EnumType($this->createMock(TypeValue::class));
        self::assertTrue($type->allowsRequired());
    }

    public function test_should_allow_default_values_that_are_in_enum(): void
    {
        $type = new EnumType(StringValue::fromString('one'), IntegerValue::fromInt(23));
        self::assertTrue($type->allowsDefaultValue(StringValue::fromString('one')));
        self::assertTrue($type->allowsDefaultValue(StringValue::fromString('23')));
        self::assertFalse($type->allowsDefaultValue(StringValue::emptyString()));
    }
}
