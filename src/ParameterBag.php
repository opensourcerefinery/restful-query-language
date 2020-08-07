<?php declare(strict_types=1);

namespace OpenSourceRefinery\Component\QueryLanguage;

use OpenSourceRefinery\Component\QueryLanguage\Types\TypeGuesser;
use OpenSourceRefinery\Component\QueryLanguage\Types\TypeValue;

final class ParameterBag
{
    /**
     * @var TypeValue[] Mapped by id in format x.y.z for easy access
     */
    private $values;

    /**
     * @param TypeValue[] $values Indexed by string key
     */
    private function __construct(array $values)
    {
        $this->values = $values;
    }

    public function has(string $parameter): bool
    {
        if (! \array_key_exists($parameter, $this->values)) {
            // search by key parts, starting with root node (root.key.value)
            $keys = \array_keys($this->values);
            return \count(
                \array_filter(
                    $keys,
                    function (string $key) use ($parameter): bool {
                        return \strpos($key, $parameter) === 0;
                    }
                )
            ) > 0;
        }

        return true;
    }

    public function get(string $parameter): TypeValue
    {
        if (! $this->has($parameter)) {
            throw new ParameterNotFound($parameter);
        }

        return $this->values[$parameter];
    }

    /**
     * @param mixed[] $array
     * @return ParameterBag
     */
    public static function fromArray(array $array): self
    {
        $closure = function (array $_flattened, string $current_node, $value, callable $closure): array {
            if (\is_array($value) && \count($value) > 0) {
                foreach ($value as $k => $v) {
                    $_flattened = $closure($_flattened, $current_node . '.' . $k, $v, $closure);
                }

                return $_flattened;
            }

            $_flattened[$current_node] = TypeGuesser::guess($value);

            return $_flattened;
        };

        $fattened_array = [];
        foreach ($array as $key => $value) {
            $fattened_array = $closure($fattened_array, $key, $value, $closure);
        }

        return new self($fattened_array);
    }

    public static function emptyBag(): self
    {
        return new self([]);
    }
}
