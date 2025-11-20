<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Core\Resolvers;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\ParameterResolver;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class ClosureResolver implements ParameterResolver
{
    /**
     * @var $callable
     */
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function apply(QueryingPlatform $platform, ParameterBag $bag): void
    {
        $callable = $this->callable;
        $callable($platform, $bag);
    }
}
