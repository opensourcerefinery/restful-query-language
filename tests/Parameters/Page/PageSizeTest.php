<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class PageSizeTest extends TestCase
{
    public function test_apply_filter(): void
    {
        $platform = new PlatformSpy();
        self::assertNull($platform->getIndex('limit'));

        PageSize::fromInt(1)->applyFilter($platform);

        self::assertSame(1, $platform->getIndex('limit'));
    }
}
