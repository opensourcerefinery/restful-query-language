<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have the following dataset
     */
    public function iHaveTheFollowingDataset(TableNode $table): void
    {
        throw new PendingException();
    }

    /**
     * @When I request the url :arg1
     */
    public function iRequestTheUrl(string $url): void
    {
        throw new PendingException();
    }

    /**
     * @Then I should have the following ids :arg1
     */
    public function iShouldHaveTheFollowingIds(string $ids): void
    {
        throw new PendingException();
    }
}
