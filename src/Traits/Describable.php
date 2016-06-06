<?php

namespace Esso\Descriptor\Traits;

use Closure;
use ReflectionClass;
use Esso\Descriptor\Expression;
use Esso\Descriptor\ExpressionAdapter;
use Esso\Descriptor\Exception\InvalidCallableException;

trait Describable {

    /**
     * @var array
     */
    private $expressions = [];

    /**
     * @return array
     */
    protected function getDefinedExpressions() { return []; }

    /**
     * @param Expression|Closure|callable(string only) $expression
     */
    public function addExpression($expression)
    {
        $this->expressions[] = ($expression instanceof Expression)
            ? $expression : $this->createExpression($expression);
    }

    /**
     * @param array $expressions
     */
    public function addExpressions(array $expressions)
    {
        foreach($expressions as $expression) {
            $this->addExpression($expression);
        }
    }

    /**
     * @param string|Closure $expression
     * @return ExpressionAdapter
     */
    protected function createExpression($expression)
    {
        $expression = is_string($this->validateExpression($expression))
            ? [$this, $expression] : $expression;

        return new ExpressionAdapter($expression);
    }

    /**
     * @param $expression
     * @throws InvalidCallableException
     * @return mixed
     */
    protected function validateExpression($expression)
    {
        if( $expression instanceof Closure
           || $this->isSelfValidCallable($expression) )
        {
            return $expression;
        }

        throw new InvalidCallableException(sprintf("Invalid callable : %s", $expression));
    }

    /**
     * @param string $expression
     * @return bool
     */
    protected function isSelfValidCallable($expression)
    {
        if(!is_string($expression)) return false;
        
        if(method_exists($this, $expression)) {

            $self = $instance = new ReflectionClass(get_class($this));

            while($current = $instance->getParentClass()) {

                if( in_array('Esso\Descriptor\Traits\Describable', $current->getTraitNames()) ) {
                    $self = $current;  break;
                }
                $instance = $current;
            }

            return ! $self->hasMethod($expression);
        }

        return false;
    }
} 