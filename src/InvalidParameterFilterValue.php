<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

final class InvalidParameterFilterValue extends \InvalidArgumentException
{
    /**
     * @param mixed $value
     * @param string $filter
     * @param string $expected
     */
    public function __construct($value, string $filter, string $expected)
    {
        parent::__construct(
            \sprintf(
                'Filter value "%s" for filter "%s" is not valid. Expected "%s".',
                $value,
                $filter,
                $expected
            )
        );
    }
}
