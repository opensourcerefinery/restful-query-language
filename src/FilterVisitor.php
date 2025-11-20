<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Types\FilterType;

interface FilterVisitor
{
    public function visitFilter(string $name, FilterType $type): void;

    public function visitOption(): void;
}
