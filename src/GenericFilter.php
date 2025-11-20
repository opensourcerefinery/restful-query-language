<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Options\ArrayOfOptions;
use OpenSourceRefinery\Component\QueryLanguage\Options\FilterOption;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;

final class GenericFilter implements FilterDefinition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterType
     */
    private $type;

    /**
     * @var ArrayOfOptions
     */
    private $options;

    public function __construct(
        string $name,
        FilterType $type,
        FilterOption ...$options
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->options = new ArrayOfOptions(...$options);

        \array_map(
            function (FilterOption $option): void {
                if (! $option->isAllowedByType($this->type)) {
                    throw $option->generateNotAllowedException($this->name, $this->type);
                }
            },
            $options
        );
    }

    public function prefillBag(ParameterBag $bag): ParameterBag
    {
        return $this->options->prefillBag($bag);
    }
}
