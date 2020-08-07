<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

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
}
