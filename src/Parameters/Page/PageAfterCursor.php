<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\Filter;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class PageAfterCursor implements Filter
{
    /**
     * @var string|null
     */
    private $value;

    private function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function applyFilter(QueryingPlatform $platform): void
    {
        if (\is_string($this->value)) {
            $platform->applyAfterCursor($this->value);
        }
    }

    public static function fromString(string $cursor): self
    {
        return self::fromMixed($cursor);
    }

    public static function fromMixed(?string $cursor): self
    {
        return new self($cursor);
    }
}
