<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage\Parameters\Page;

use OpenSourceRefinery\Component\QueryLanguage\InvalidParameterFilterValue;
use OpenSourceRefinery\Component\QueryLanguage\MissingRequiredParameter;
use OpenSourceRefinery\Component\QueryLanguage\NotSetParameter;
use OpenSourceRefinery\Component\QueryLanguage\ParameterBag;
use OpenSourceRefinery\Component\QueryLanguage\Platforms\PlatformSpy;
use OpenSourceRefinery\Component\QueryLanguage\Types\InvalidTypeValue;
use PHPUnit\Framework\TestCase;

final class PageParameterTest extends TestCase
{
    /**
     * @var PageParameter
     */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new PageParameter();
    }

    public function test_it_should_throw_exception_when_missing_start_parameter(): void
    {
        $this->expectException(MissingRequiredParameter::class);
        $this->expectExceptionMessage('Parameter "start" is required when using "limit".');
        $this->factory->createParameter(ParameterBag::fromArray(['page' => ['limit' => 2]]));
    }

    public function test_it_should_throw_exception_when_missing_limit_parameter(): void
    {
        $this->expectException(MissingRequiredParameter::class);
        $this->expectExceptionMessage('Parameter "limit" is required when using "start".');
        $this->factory->createParameter(ParameterBag::fromArray(['page' => ['start' => 2]]));
    }

    public function test_it_should_allow_no_pagination_parameters(): void
    {
        $param = $this->factory->createParameter(ParameterBag::emptyBag());
        self::assertInstanceOf(NotSetParameter::class, $param);
    }

    public function test_it_should_parse_start_and_limit_parameters(): void
    {
        $param = $this->factory->createParameter(
            ParameterBag::fromArray(['page' => ['start' => 2, 'limit' => 3]])
        );
        self::assertInstanceOf(OffsetPagination::class, $param);
    }

    /**
     * @param mixed $value
     * @param \Exception $exception
     * @dataProvider provideInvalidStartValue
     */
    public function test_it_should_not_allow_invalid_start($value, \Exception $exception): void
    {
        $this->expectExceptionObject($exception);
        $this->factory->createParameter(
            ParameterBag::fromArray(['page' => ['start' => $value, 'limit' => 3]])
        );
    }

    /**
     * @return array[]
     */
    public static function provideInvalidStartValue(): array
    {
        return [
            'Do not allow negative int' => [
                -1,
                new InvalidParameterFilterValue(-1, "page.start", 'Int greater than zero'),
            ],
            'Do not allow zero limit' => [
                0,
                new InvalidParameterFilterValue(0, "page.start", 'Int greater than zero'),
            ],
            'Do not allow string' => [
                'string',
                new InvalidTypeValue('Value "string" was expected to be integer, but is not.'),
            ],
        ];
    }

    /**
     * @param mixed $value
     * @param \Exception $exception
     * @dataProvider provideInvalidLimitValue
     */
    public function test_it_should_not_allow_invalid_limit($value, \Exception $exception): void
    {
        $this->expectExceptionObject($exception);
        $this->factory->createParameter(
            ParameterBag::fromArray(['page' => ['start' => 3, 'limit' => $value]])
        );
    }

    /**
     * @return array[]
     */
    public static function provideInvalidLimitValue(): array
    {
        return [
            'Do not allow negative int' => [
                -2,
                new InvalidParameterFilterValue(
                    -2,
                    "page.limit",
                    'Int greater than zero or -1 (for unlimited)'
                ),
            ],
            'Do not allow string' => [
                'string',
                new InvalidTypeValue('Value "string" was expected to be integer, but is not.'),
            ],
        ];
    }

    public function test_it_should_allow_optional_page_size(): void
    {
        $parameter = $this->factory->createParameter(
            ParameterBag::fromArray(
                [
                    'page' => [
                        'size' => 1,
                    ]
                ]
            )
        );
        $platform = new PlatformSpy();
        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));

        $parameter->apply($platform);

        self::assertSame(1, $platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));
    }

    public function test_it_should_allow_optional_page_before_cursor(): void
    {
        $parameter = $this->factory->createParameter(
            ParameterBag::fromArray(
                [
                    'page' => [
                        'before' => '_before',
                    ]
                ]
            )
        );
        $platform = new PlatformSpy();
        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));

        $parameter->apply($platform);

        self::assertNull($platform->getIndex('limit'));
        self::assertSame('_before', $platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));
    }

    public function test_it_should_allow_optional_page_after_cursor(): void
    {
        $parameter = $this->factory->createParameter(
            ParameterBag::fromArray(
                [
                    'page' => [
                        'after' => '_after',
                    ]
                ]
            )
        );
        $platform = new PlatformSpy();
        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));

        $parameter->apply($platform);

        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertSame('_after', $platform->getIndex('after'));
    }

    public function test_it_should_apply_all_cursor_options(): void
    {
        $parameter = $this->factory->createParameter(
            ParameterBag::fromArray(
                [
                    'page' => [
                        'size' => 1,
                        'before' => '_before',
                        'after' => '_after',
                    ]
                ]
            )
        );
        $platform = new PlatformSpy();
        self::assertNull($platform->getIndex('limit'));
        self::assertNull($platform->getIndex('before'));
        self::assertNull($platform->getIndex('after'));

        $parameter->apply($platform);

        self::assertSame(1, $platform->getIndex('limit'));
        self::assertSame('_before', $platform->getIndex('before'));
        self::assertSame('_after', $platform->getIndex('after'));
    }
}
