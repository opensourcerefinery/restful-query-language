<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;
use OpenSourceRefinery\Component\QueryLanguage\Typing\NotAllowedOption;

interface FilterOption
{
    /**
     * Whether the type allows the option.
     *
     * @param FilterType $type
     * @return bool
     */
    public function isAllowedByType(FilterType $type): bool;

    /**
     * Generate the exception when isAllowedByType() return false.
     *
     * @param string $filterName
     * @param FilterType $type
     * @return NotAllowedOption
     */
    public function generateNotAllowedException(string $filterName, FilterType $type): NotAllowedOption;

    public function prefillBag(ParameterBag $bag): ParameterBag;
}
