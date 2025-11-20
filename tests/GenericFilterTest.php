<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Options\DefaultValue;
use OpenSourceRefinery\Component\QueryLanguage\Options\RequiredFilter;
use OpenSourceRefinery\Component\QueryLanguage\Types\Doubles\FilterThatNeverAllowsAnything;
use OpenSourceRefinery\Component\QueryLanguage\Types\StringValue;
use OpenSourceRefinery\Component\QueryLanguage\Typing\NotAllowedOption;
use PHPUnit\Framework\TestCase;

final class GenericFilterTest extends TestCase
{
    public function test_should_throw_exception_when_filter_do_not_allow_required(): void
    {
        $this->expectException(NotAllowedOption::class);
        $this->expectExceptionMessage('Filter "name" is not allowed to be required.');

        new GenericFilter(
            'name',
            new FilterThatNeverAllowsAnything(),
            new RequiredFilter()
        );
    }

    public function test_should_throw_exception_when_filter_do_not_allow_default_value(): void
    {
        $this->expectException(NotAllowedOption::class);
        $this->expectExceptionMessage('Filter "name" is not allowed to have "default" as default value.');

        new GenericFilter(
            'name',
            new FilterThatNeverAllowsAnything(),
            new DefaultValue(StringValue::fromString('default'))
        );
    }
}
