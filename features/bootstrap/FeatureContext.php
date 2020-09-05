<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use OpenSourceRefinery\Component\QueryLanguage\Parameters\Page\PageParameter;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    const RESOURCE_URL = '/resource';

    /**
     * @var QueryLanguageEngine
     */
    private $engine;

    /**
     * @var QueryingPlatform
     */
    private $platform;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->engine = new QueryLanguageEngine();
        $this->platform = new PlatformSpy();
    }

    /**
     * @When I request the url with the :arg1 parameter
     */
    public function iRequestTheUrlWithTheParameter(string $key, TableNode $table): void
    {
        $this->engine->registerFactory(new PageParameter());

        $parameters = [];
        foreach ($table->getHash() as $rows) {
            foreach ($rows as $parameter => $value) {
                if ($parameter === 'json') {
                    $parameters[$key] = $value;
                    continue;
                }

                $parameters[$key][$parameter] = $value;
            }
        }

        $this->engine->applyParameters(ParameterBag::fromArray($parameters), $this->platform);
    }

    /**
     * @Then I should have the following response
     */
    public function iShouldHaveTheFollowingResponse(string $expected): void
    {
        Assert::assertJsonStringEqualsJsonString($expected, $this->platform->toJson());
    }
}
