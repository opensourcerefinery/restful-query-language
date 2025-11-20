<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Testers;

use OpenSourceRefinery\Component\QueryLanguage\Core\Resolvers\ClosureResolver;
use OpenSourceRefinery\Component\QueryLanguage\Engine;
use OpenSourceRefinery\Component\QueryLanguage\GenericFilter;
use OpenSourceRefinery\Component\QueryLanguage\Options\FilterOption;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;
use OpenSourceRefinery\Component\QueryLanguage\QueryLanguageEngine;
use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;

final class OptionTester
{
    /**
     * @var Engine
     */
    private $engine;

    public function __construct(FilterType $type, FilterOption $option)
    {
        $this->engine = new QueryLanguageEngine();
        $this->engine->createDefinition(
            'test',
            new ClosureResolver(
                function (QueryingPlatform $platform, ParameterBag $bag): void {
                    $platform->applyAfterCursor($bag->get('test')->toString());
                }
            ),
            new GenericFilter(
                'filter',
                $type,
                $option
            )
        );
    }

    public function requestParameter(ParameterBag $bag): PlatformSpy
    {
        $this->engine->applyParameters($bag, $platform = new PlatformSpy());

        return $platform;
    }

}
