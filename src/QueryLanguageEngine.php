<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Core\Visitors\HandleDefaultValues;
use OpenSourceRefinery\Component\QueryLanguage\Core\Visitors\ValidateFilterOptions;

final class QueryLanguageEngine implements Engine
{
    /**
     * @var ParameterFactory[]
     */
    private $factories = [];

    public function applyParameters(ParameterBag $parameters, QueryingPlatform $platform): void
    {
        foreach ($this->factories as $factory) {
            $parameter = $factory->createParameter($parameters);

            $parameter->acceptParameterVisitor(new HandleDefaultValues());
            $parameter->acceptParameterVisitor(new ValidateFilterOptions());

            $parameter->apply($platform);
        }
    }

    public function createDefinition(
        string $name,
        ParameterResolver $resolver,
        FilterDefinition $filter
    ): ParameterDefinition {
        $definition = new ParameterDefinition($name, $filter, $resolver);
        $this->registerFactory($definition);

        return $definition;
    }

    public function registerFactory(ParameterFactory $handler): void
    {
        $this->factories[] = $handler;
    }
}
