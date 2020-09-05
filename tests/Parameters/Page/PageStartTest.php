<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\InvalidParameterFilterValue;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class PageStartTest extends TestCase
{
    public function test_should_return_value_as_int(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('start'));

        PageStart::fromInt(1)->applyFilter($platform);

        self::assertSame(1, $platform->getIndex('start'));
    }

    public function test_it_should_not_allow_value_lower_than_zero(): void
    {
        $this->expectException(InvalidParameterFilterValue::class);
        $this->expectExceptionMessage(
            'Filter value "-1" for filter "page.start" is not valid. Expected "Int greater than zero".'
        );
        PageStart::fromInt(-1);
    }

    public function test_it_should_not_allow_value_of_zero(): void
    {
        $this->expectException(InvalidParameterFilterValue::class);
        $this->expectExceptionMessage(
            'Filter value "0" for filter "page.start" is not valid. Expected "Int greater than zero".'
        );
        PageStart::fromInt(0);
    }
}
