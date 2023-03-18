<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    protected $request;

    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
//https://www.youtube.com/watch?v=7XqEJO-wt7s&t=981s
// Here's what the code does:

// The apply method accepts a Builder object which represents the query builder instance.
// The $this->builder = $builder line sets the query builder instance on the filter object, so that it can be modified by the filter methods.
// The foreach loop iterates over the filters defined in the filters method and calls the corresponding filter method for each filter.
// The method_exists check makes sure that the filter method actually exists in the filter class.
// The call_user_func_array line calls the filter method and passes in the filter value as an argument. The array_filter([$value]) call is used to remove any null or empty values from the array of arguments.
// The filter method modifies the query builder instance as necessary.
// Finally, the apply method returns the modified query builder instance, so that it can be used to execute the query.
// Overall, this code is responsible for applying the filters to the query builder instance in a dynamic and flexible way, based on the filters defined in the filters method of the filter class.


// Here's what the code does:

// The filters method returns all the parameters from the request object by calling the all method on the request object.
// The all method returns an associative array of all the parameters from the request, where the keys are the parameter names and the values are the parameter values.
// This method is used in the apply method of the filter class to loop over all the filters and apply them to the query builder instance.
// Overall, this code is a simple way to retrieve all the filters from the incoming HTTP request, without having to manually parse each parameter name and value from the request object.