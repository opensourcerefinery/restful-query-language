<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;
use OpenSourceRefinery\Component\QueryLanguage\Typing\NotAllowedOption;

final class RequiredFilter implements FilterOption
{
    public function isAllowedByType(FilterType $type): bool
    {
        return $type->allowsRequired();
    }

    public function generateNotAllowedException(string $filterName, FilterType $type): NotAllowedOption
    {
        return NotAllowedOption::notAllowedAction($filterName, 'be required');
    }

    public function prefillBag(ParameterBag $bag): ParameterBag
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }
}
