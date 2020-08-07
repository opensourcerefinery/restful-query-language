<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;
use OpenSourceRefinery\Component\QueryLanguage\QueryParameter;

/**
 * @see http://jsonapi.org/profiles/ethanresnick/cursor-pagination
 */
final class CursorPagination implements QueryParameter
{
    /**
     * @var PageSize
     */
    private $size;

    /**
     * @var PageBeforeCursor
     */
    private $beforeCursor;

    /**
     * @var PageAfterCursor
     */
    private $afterCursor;

    private function __construct(PageSize $size, PageBeforeCursor $beforeCursor, PageAfterCursor $afterCursor)
    {
        $this->size = $size;
        $this->beforeCursor = $beforeCursor;
        $this->afterCursor = $afterCursor;
    }

    public function apply(QueryingPlatform $platform): void
    {
        $this->size->applyFilter($platform);
        $this->beforeCursor->applyFilter($platform);
        $this->afterCursor->applyFilter($platform);
    }

    public static function fromScalar(?int $size, ?string $before, ?string $after): self
    {
        return new self(
            PageSize::fromMixed($size),
            PageBeforeCursor::fromMixed($before),
            PageAfterCursor::fromMixed($after)
        );
    }
}
