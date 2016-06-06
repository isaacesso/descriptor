<?php

namespace Esso\Descriptor;

/**
 * Class ExpressionAdapter
 * @package Esso\Descriptor
 */
final class ExpressionAdapter implements Expression {

    /**
     * @var callable
     */
    private $method;

    /**
     * @param callable $method
     */
    public function __construct(callable $method)
    {
        $this->method = $method;
    }

    /**
     * @param Description $description
     * @return mixed
     */
    public function describe(Description $description)
    {
        return call_user_func_array($this->method, [$description]);
    }
}