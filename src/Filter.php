<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface Filter
{
    public function applyFilter(QueryingPlatform $platform): void;
}
