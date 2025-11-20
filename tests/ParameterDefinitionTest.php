<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use OpenSourceRefinery\Component\QueryLanguage\Types\StringType;
use PHPUnit\Framework\TestCase;

final class ParameterDefinitionTest extends TestCase
{
    public function test_should_create_executable_parameter(): void
    {
        $resolver = $this->createMock(ParameterResolver::class);
        $resolver
            ->expects($this->once())
            ->method('apply');

        $definition = new ParameterDefinition(
            'name',
            new GenericFilter('string', new StringType()),
            $resolver
        );

        $bag = ParameterBag::fromArray(['name' => 'value']);
        $parameter = $definition->createParameter($bag);
        $parameter->apply($platform = new PlatformSpy());
    }
}
