<?php

namespace Esso\Descriptor;

/**
 * Interface DescriptorInterface
 * @package Esso\Descriptor
 */
interface DescriptorInterface {

    /**
     * @param Expression|Closure|callable(string only) $expression
     */
    public function addExpression($expression);

    /**
     * @param array $expressions
     */
    public function addExpressions(array $expressions);

    /**
     * Get description.
     *
     * @return Description
     */
    public function describe();
} 