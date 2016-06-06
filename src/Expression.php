<?php

namespace Esso\Descriptor;

/**
 * Interface Expression
 * @package Esso\Descriptor
 */
interface Expression {

    /**
     * @param Description $description
     * @return mixed
     */
    public function describe(Description $description);
}