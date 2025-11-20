<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Filtering;

use OpenSourceRefinery\Component\QueryLanguage\FilterDefinition;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;

final class ArrayOfFilterDefinitions implements FilterDefinition
{
    /**
     * @var FilterDefinition[]
     */
    private $definitions;

    public function __construct(FilterDefinition ...$definitions)
    {
        $this->definitions = $definitions;
    }

    public function prefillBag(ParameterBag $bag): ParameterBag
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }
}
