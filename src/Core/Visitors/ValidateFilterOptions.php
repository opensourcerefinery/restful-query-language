<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Core\Visitors;

use OpenSourceRefinery\Component\QueryLanguage\FilterVisitor;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;

final class ValidateFilterOptions implements FilterVisitor
{
    /**
     * @var ParameterBag
     */
    private $bag;

    public function __construct(ParameterBag $bag)
    {
        $this->bag = $bag;
    }


}
