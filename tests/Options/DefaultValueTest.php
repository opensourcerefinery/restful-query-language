<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Testers\OptionTester;
use OpenSourceRefinery\Component\QueryLanguage\Types\StringType;
use OpenSourceRefinery\Component\QueryLanguage\Types\StringValue;
use PHPUnit\Framework\TestCase;

final class DefaultValueTest extends TestCase
{
    public function test_use_default_value_when_filter_not_set(): void
    {
        $tester = new OptionTester(
            new StringType(),
            new DefaultValue(StringValue::fromString('default'))
        );

        $platform = $tester->requestParameter(ParameterBag::emptyBag());
        $this->assertSame('{"test":"default"}', $platform->toJson());
    }
}
