<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

interface QueryingPlatform
{
    public function applyLimit(int $limit): void;
    public function applyOffset(int $offset): void;
    public function applyBeforeCursor(string $cursor): void;
    public function applyAfterCursor(string $cursor): void;
}
