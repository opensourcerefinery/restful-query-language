<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Options;

use PHPUnit\Framework\TestCase;

final class ArrayOfOptionsTest extends TestCase
{
    public function test_it_should_be_immutable_when_adding_options(): void
    {
        $original = new ArrayOfOptions();

        $this->assertCount(0, $original);

        $withOne = $original->addOption($this->createMock(FilterOption::class));

        $this->assertCount(0, $original);
        $this->assertCount(1, $withOne);

        $withThree = $withOne
            ->addOption($this->createMock(FilterOption::class))
            ->addOption($this->createMock(FilterOption::class));

        $this->assertCount(0, $original);
        $this->assertCount(1, $withOne);
        $this->assertCount(3, $withThree);
    }
}
