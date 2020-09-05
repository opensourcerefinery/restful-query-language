<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Types;

interface TypeValue
{
    public function toString(): string;

    public function toInt(): int;
}
