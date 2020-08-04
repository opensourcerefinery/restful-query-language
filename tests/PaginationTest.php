<?php declare(strict_types=1);

namespace OpenSourceRefinery;

use OpenSourceRefinery\Component\QueryLanguage\Pagination;
use PHPUnit\Framework\TestCase;

final class PaginationTest extends TestCase
{
    public function test_it_passes(): void
    {
        $pagination = new Pagination();
        $this->assertTrue(true);
    }
}
