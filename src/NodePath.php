<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;

final class NodePath
{
    private const DELIMITER = '.';

    /**
     * @var string
     */
    private $path;

    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public function toString(): string
    {
        return $this->path;
    }

    public function formatValue(TypeValue $value): array
    {
        $parts = \array_reverse(\explode(self::DELIMITER, $this->path));
        $return = [];
        foreach ($parts as $part) {
            $return[$part] = $value;
            $value = $return;
            unset($return[$part]);
        }

        return $value;
    }

    public static function fromString(string $path): self
    {
        return new self($path);
    }
}
