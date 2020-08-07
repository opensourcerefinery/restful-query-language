<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class OffsetPaginationTest extends TestCase
{
    public function test_it_should_filter_result_using_offset(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('start'));

        OffsetPagination::fromInt(2, 3)->apply($platform);

        self::assertSame(2, $platform->getIndex('start'));
        self::assertSame(3, $platform->getIndex('limit'));
    }
}
