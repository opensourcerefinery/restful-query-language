<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Typing;

final class NotAllowedOption extends \LogicException
{
    public static function notAllowedAction(string $name, string $description): self
    {
        return new self(\sprintf('Filter "%s" is not allowed to %s.', $name, $description));
    }
}
