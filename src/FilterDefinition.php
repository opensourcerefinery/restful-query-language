<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface FilterDefinition
{
    public function prefillBag(ParameterBag $bag): ParameterBag;
}
