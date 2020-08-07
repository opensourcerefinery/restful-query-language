<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Filter;
use OpenSourceRefinery\Component\QueryLanguage\InvalidParameterFilterValue;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class PageStart implements Filter
{
    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        if ($value <= 0) {
            throw new InvalidParameterFilterValue($value, 'page.start', 'Int greater than zero');
        }

        $this->value = $value;
    }

    public function applyFilter(QueryingPlatform $platform): void
    {
        $platform->applyOffset($this->value);
    }

    public static function fromInt(int $start): self
    {
        return new self($start);
    }
}
