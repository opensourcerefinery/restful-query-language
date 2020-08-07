<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface ParameterFactory
{
    public function createParameter(ParameterBag $bag): QueryParameter;
}
