<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class PageBeforeCursorTest extends TestCase
{
    public function test_should_apply_the_cursor(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('before'));

        PageBeforeCursor::fromString('value')->applyFilter($platform);

        self::assertSame('value', $platform->getIndex('before'));
    }

    public function test_should_not_apply_cursor_when_null(): void
    {
        $platform = new PlatformSpy();

        self::assertNull($platform->getIndex('before'));

        PageBeforeCursor::fromMixed(null)->applyFilter($platform);

        self::assertNull($platform->getIndex('before'));
    }
}
