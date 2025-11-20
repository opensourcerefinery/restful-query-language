<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Core\Visitors;

use OpenSourceRefinery\Component\QueryLanguage\FilterVisitor;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;

final class HandleDefaultValues implements FilterVisitor
{
    /**
     * @var ParameterBag
     */
    private $bag;

    public function __construct(ParameterBag $bag)
    {
        $this->bag = $bag;
    }

    public function visitFilter(string $name, FilterType $type): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    public function visitOption(): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }
}
