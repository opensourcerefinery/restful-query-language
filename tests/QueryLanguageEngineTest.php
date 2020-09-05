<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Parameters\ClosureParameter;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\TestCase;

final class QueryLanguageEngineTest extends TestCase
{
    public function test_it_should_apply_parameters(): void
    {
        $engine = new QueryLanguageEngine();
        $parameter = $this->createMock(QueryParameter::class);
        $parameter
            ->expects(self::once())
            ->method('apply');

        $factory = $this->createMock(ParameterFactory::class);
        $factory
            ->expects(self::once())
            ->method('createParameter')
            ->willReturn($parameter);

        $engine->registerFactory($factory);

        $engine->applyParameters(
            ParameterBag::fromArray(['key' => 'value']),
            $this->createMock(QueryingPlatform::class)
        );
    }

    public function test_it_should_build_custom_definition_with_filter(): void
    {
        $this->markTestIncomplete('todo');
        $engine = new QueryLanguageEngine();
        $definition = $engine->createDefinition(
            'sort',
            new ClosureParameter(
                function (QueryingPlatform $platform, ParameterBag $bag): void {
                    throw new \RuntimeException('Definition works');
                }
            )
        );
        $definition->addStringFilter('property')->required();
        $definition->addEnumFilter('direction', ['asc', 'desc'])->defaultValue('desc');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Definition works');
        $engine->applyParameters(
            ParameterBag::fromArray(
                [
                    'sort' => [
                        'property' => 'field',
                        'direction' => 'asc',
                    ],
                ]
            ),
            $platform = new PlatformSpy()
        );
    }

    public function test_it_should_build_custom_definition_with_no_filter(): void
    {
        $this->markTestIncomplete('todo');
        $this->fail('todo');
        $engine = new QueryLanguageEngine();
        $definition = $engine->createDefinition(
            'id',
            new ClosureParameter(
                function (QueryingPlatform $platform, ParameterBag $bag): void {
                    throw new \RuntimeException(__METHOD__ . ' not implemented yet.');
                }
            )
        );
        $definition->markAsRootFilter();
    }
}
