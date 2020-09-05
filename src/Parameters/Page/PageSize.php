<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Filter;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class PageSize implements Filter
{
    /**
     * @var int|null
     */
    private $value;

    private function __construct(?int $value)
    {
        $this->value = $value;
    }

    public function applyFilter(QueryingPlatform $platform): void
    {
        if (null !== $this->value) {
            $platform->applyLimit($this->value);
        }
    }

    public static function fromInt(int $size): self
    {
        return self::fromMixed($size);
    }

    public static function fromMixed(?int $size): self
    {
        return new self($size);
    }
}
