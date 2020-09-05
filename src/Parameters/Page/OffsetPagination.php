<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\QueryParameter;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class OffsetPagination implements QueryParameter
{
    /**
     * @var PageStart
     */
    private $start;

    /**
     * @var PageLimit
     */
    private $limit;

    public function __construct(PageStart $start, PageLimit $limit)
    {
        // todo add validation of values greater than 0
        $this->start = $start;
        $this->limit = $limit;
    }

    public function apply(QueryingPlatform $platform): void
    {
        $this->limit->applyFilter($platform);
        $this->start->applyFilter($platform);
    }

    public static function fromInt(int $start, int $limit): self
    {
        return new self(PageStart::fromInt($start), PageLimit::fromInt($limit));
    }
}
