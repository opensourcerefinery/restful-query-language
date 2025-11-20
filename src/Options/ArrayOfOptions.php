<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;
use OpenSourceRefinery\Component\QueryLanguage\Typing\NotAllowedOption;

final class ArrayOfOptions implements FilterOption, \Countable
{
    /**
     * @var FilterOption[]
     */
    private $options;

    public function __construct(FilterOption ...$options)
    {
        $this->options = $options;
    }

    public function addOption(FilterOption $option): self
    {
        return new self(...\array_merge($this->options, [$option]));
    }

    public function count(): int
    {
        return \count($this->options);
    }

    public function isAllowedByType(FilterType $type): bool
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    public function generateNotAllowedException(string $filterName, FilterType $type): NotAllowedOption
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    public function prefillBag(ParameterBag $bag): ParameterBag
    {
        foreach ($this->options as $option) {
            $bag = $option->prefillBag($bag);
        }

        return $bag;
    }
}
