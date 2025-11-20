<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;
use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;
use OpenSourceRefinery\Component\QueryLanguage\Typing\NotAllowedOption;

final class DefaultValue implements FilterOption
{
    /**
     * @var TypeValue
     */
    private $value;

    public function __construct(TypeValue $value)
    {
        $this->value = $value;
    }

    public function isAllowedByType(FilterType $type): bool
    {
        return $type->allowsDefaultValue($this->value);
    }

    public function generateNotAllowedException(string $filterName, FilterType $type): NotAllowedOption
    {
        return NotAllowedOption::notAllowedAction(
            $filterName,
            \sprintf('have "%s" as default value', $this->value->toString())
        );
    }

    public function prefillBag(ParameterBag $bag): ParameterBag
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }
}
