<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

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
            $parameter->apply($platform);
        }
    }

    public function registerFactory(ParameterFactory $handler): void
    {
        $this->factories[] = $handler;
    }
}
