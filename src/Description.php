<?php


namespace Esso\Descriptor;

use Illuminate\Support\Fluent;

class Description extends Fluent {

    public function pull($key)
    {
        if($value = $this[$key]) {

            unset($this[$key]);

            return $value;
        }

        return null;
    }
}