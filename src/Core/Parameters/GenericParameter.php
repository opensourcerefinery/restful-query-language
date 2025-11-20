<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Core\Parameters;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\ParameterResolver;
use OpenSourceRefinery\Component\QueryLanguage\ParameterVisitor;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;
use OpenSourceRefinery\Component\QueryLanguage\QueryParameter;

final class GenericParameter implements QueryParameter
{
    /**
     * @var ParameterResolver
     */
    private $resolver;

    /**
     * @var ParameterBag
     */
    private $bag;

    public function __construct(ParameterResolver $resolver, ParameterBag $bag)
    {
        $this->resolver = $resolver;
        $this->bag = $bag;
    }

    public function acceptParameterVisitor(ParameterVisitor $visitor): void
    {
        throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
    }

    public function apply(QueryingPlatform $platform): void
    {
        $this->resolver->apply($platform, $this->bag);
    }
}
