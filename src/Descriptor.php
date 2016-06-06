<?php

namespace Esso\Descriptor;

use Esso\Descriptor\Traits\Describable;

/**
 * Class Descriptor
 * @package Esso\Descriptor
 */
class Descriptor implements DescriptorInterface {

    use Describable;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addExpressions($this->getDefinedExpressions());
    }

    /**
     * Get description.
     *
     * @return Description
     */
    public function describe()
    {
        $description = new Description();

        foreach($this->expressions as $expression) {
            $expression->describe($description);
        }

        return $description;
    }
}