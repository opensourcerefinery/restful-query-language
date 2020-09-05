<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

/**
 * Object that handles the resolution of a validated parameter.
 */
interface ParameterResolver
{
    /**
     * @param QueryingPlatform $platform
     * @param ParameterBag $bag The validated filters registered through the definition
     */
    public function apply(QueryingPlatform $platform, ParameterBag $bag): void;
}
