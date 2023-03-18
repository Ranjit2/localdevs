<?php 

namespace App\Http\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ExperienceFilter extends Filter
{
    public function handle(Builder $query, Closure $next)
    {
        if (array_key_exists('experience', $this->request->filters) && $this->request->filters['experience']) {
            $arrayNumber = explode('-', $this->request->filters['experience']);
            $firstValue = $arrayNumber[0];
            $secondValue = $arrayNumber[1];
            //two digit numbers are considered as string, so convert to int with intval
            $query->whereBetween('experience', [$firstValue, intval($secondValue)]);
        }

        return $next($query);
    }
}
