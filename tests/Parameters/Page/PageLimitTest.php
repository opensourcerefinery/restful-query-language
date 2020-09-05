<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\InvalidParameterFilterValue;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class PageLimitTest extends TestCase
{
    public function test_should_return_limit_as_int(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('limit'));

        PageLimit::fromInt(1)->applyFilter($platform);

        self::assertSame(1, $platform->getIndex('limit'));
    }

    public function test_should_return_unlimited_limit_as_int(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('limit'));

        PageLimit::unlimited()->applyFilter($platform);

        self::assertSame(-1, $platform->getIndex('limit'));
    }

    public function test_it_should_not_allow_value_lower_than_zero_except_unlimited(): void
    {
        $this->expectException(InvalidParameterFilterValue::class);
        $this->expectExceptionMessage('Filter value "-2" for filter "page.limit" is not valid.');
        PageLimit::fromInt(-2);
    }

    public function test_it_should_not_allow_value_of_zero(): void
    {
        $this->expectException(InvalidParameterFilterValue::class);
        $this->expectExceptionMessage('Filter value "0" for filter "page.limit" is not valid');
        PageLimit::fromInt(0);
    }
}
