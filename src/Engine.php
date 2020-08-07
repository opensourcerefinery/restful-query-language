<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface Engine
{
    public function applyParameters(ParameterBag $parameters, QueryingPlatform $platform): void;

    public function registerFactory(ParameterFactory $handler): void;
}
