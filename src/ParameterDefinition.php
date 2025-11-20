<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Core\Parameters\GenericParameter;
use OpenSourceRefinery\Component\QueryLanguage\Core\Visitors\HandleDefaultValues;
use OpenSourceRefinery\Component\QueryLanguage\Core\Visitors\ValidateFilterOptions;

final class ParameterDefinition implements ParameterFactory
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterDefinition
     */
    private $definition;

    /**
     * @var ParameterResolver
     */
    private $resolver;

    public function __construct(
        string $name,
        FilterDefinition $definition,
        ParameterResolver $resolver
    ) {
        $this->name = $name;
        $this->definition = $definition;
        $this->resolver = $resolver;
    }

    public function createParameter(ParameterBag $bag): QueryParameter
    {
        $bag = $this->definition->prefillBag($bag);
       # $this->definition->acceptFilterVisitor(new ValidateFilterOptions($bag));

        return new GenericParameter($this->resolver, $bag);
    }
}
