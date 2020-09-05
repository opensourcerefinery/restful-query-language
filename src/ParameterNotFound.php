<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

final class ParameterNotFound extends \InvalidArgumentException
{
    public function __construct(string $key)
    {
        parent::__construct(\sprintf('Parameter "%s" was not found in the bag.', $key));
    }
}
