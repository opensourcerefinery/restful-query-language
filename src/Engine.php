<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface Engine
{
    public function applyParameters(ParameterBag $parameters, QueryingPlatform $platform): void;

    public function createDefinition(string $name, ParameterResolver $resolver): Definition;

    public function registerFactory(ParameterFactory $handler): void;
}
