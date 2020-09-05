<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Filter;
use OpenSourceRefinery\Component\QueryLanguage\InvalidParameterFilterValue;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class PageLimit implements Filter
{
    private const UNLIMITED_LIMIT = -1;

    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        if (! ($value > 0 || $value === self::UNLIMITED_LIMIT)) {
            throw new InvalidParameterFilterValue(
                $value,
                'page.limit',
                'Int greater than zero or -1 (for unlimited)'
            );
        }

        $this->value = $value;
    }

    public function applyFilter(QueryingPlatform $platform): void
    {
        $platform->applyLimit($this->value);
    }

    public static function fromInt(int $limit): self
    {
        return new self($limit);
    }

    public static function unlimited(): self
    {
        return self::fromInt(self::UNLIMITED_LIMIT);
    }
}
