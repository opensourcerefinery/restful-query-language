<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\MissingRequiredParameter;
use OpenSourceRefinery\Component\QueryLanguage\NotSetParameter;
use OpenSourceRefinery\Component\QueryLanguage\ParameterFactory;
use OpenSourceRefinery\Component\QueryLanguage\QueryParameter;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;

final class PageParameter implements ParameterFactory
{
    /**
     * @var int todo apply limit by endpoint
     */
    private $maximumLimit;

    public function createParameter(ParameterBag $bag): QueryParameter
    {
        if (! $bag->has('page')) {
            // todo make a default offset when not defined ?
            return new NotSetParameter();
        }

        if ($bag->has('page.start') || $bag->has('page.limit')) {
            return $this->createOffsetPagination($bag);
        }

        return $this->createCursorPagination($bag);
    }

    private function createOffsetPagination(ParameterBag $bag): QueryParameter
    {
        // todo also handle the cursor parameter here
        if (! $bag->has('page.start')) {
            throw new MissingRequiredParameter('Parameter "start" is required when using "limit".');
        }

        if (! $bag->has('page.limit')) {
            throw new MissingRequiredParameter('Parameter "limit" is required when using "start".');
        }

        return OffsetPagination::fromInt($bag->get('page.start')->toInt(), $bag->get('page.limit')->toInt());
    }

    private function createCursorPagination(ParameterBag $bag): QueryParameter
    {
        $pageSize = null;
        if ($bag->has('page.size')) {
            $pageSize = $bag->get('page.size')->toInt();
        }

        $pageBefore = null;
        if ($bag->has('page.before')) {
            $pageBefore = $bag->get('page.before')->toString();
        }

        $pageAfter = null;
        if ($bag->has('page.after')) {
            $pageAfter = $bag->get('page.after')->toString();
        }

        return CursorPagination::fromScalar($pageSize, $pageBefore, $pageAfter);
    }
}
