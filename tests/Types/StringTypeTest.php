<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

use PHPUnit\Framework\TestCase;

final class StringTypeTest extends TestCase
{
    /**
     * @var StringType
     */
    private $type;

    protected function setUp(): void
    {
        $this->type = new StringType();
    }

    public function test_it_should_allows_required(): void
    {
        $this->assertTrue($this->type->allowsRequired());
    }

    public function test_it_should_allows_empty_default_value(): void
    {
        $this->assertTrue($this->type->allowsDefaultValue(StringValue::emptyString()));
    }

    public function test_it_should_allows_not_empty_default_value(): void
    {
        $this->assertTrue($this->type->allowsDefaultValue(StringValue::fromString('something')));
    }
}
