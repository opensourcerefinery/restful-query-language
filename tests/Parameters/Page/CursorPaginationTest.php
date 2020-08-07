<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class CursorPaginationTest extends TestCase
{
    public function test_it_should_apply_pagination(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));

        CursorPagination::fromScalar(2, '_before', '_after')->apply($platform);

        self::assertSame(2, $platform->getIndex('limit'));
        self::assertSame('_before', $platform->getIndex('before'));
        self::assertSame('_after', $platform->getIndex('after'));
    }
}
