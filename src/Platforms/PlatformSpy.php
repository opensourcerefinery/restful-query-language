<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Platforms;

use OpenSourceRefinery\Component\QueryLanguage\QueryingPlatform;

final class PlatformSpy implements QueryingPlatform
{
    /**
     * @var mixed[]
     */
    private $data = [];

    public function applyLimit(int $limit): void
    {
        $this->data['limit'] = $limit;
    }

    public function applyOffset(int $offset): void
    {
        $this->data['start'] = $offset;
    }

    public function applyBeforeCursor(string $cursor): void
    {
        $this->data['before'] = $cursor;
    }

    public function applyAfterCursor(string $cursor): void
    {
        $this->data['after'] = $cursor;
    }

    /**
     * @param string $index
     * @return mixed|null
     */
    public function getIndex(string $index)
    {
        if (\array_key_exists($index, $this->data)) {
            return $this->data[$index];
        }

        return null;
    }

    public function toJson(): string
    {
        return (string) \json_encode($this->data);
    }
}
