<?php 

namespace App\Http\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class PreferenceFilter extends Filter
{
    public function handle(Builder $query, Closure $next)
    {
        if (array_key_exists('preference', $this->request->filters) && $this->request->filters['preference']) {
            $query->where(function($queryBuilder) use ($query) {
                $queryBuilder->whereIn('workPreference', $this->request->filters['preference'])
                    ->orWhere('workPreference', 'wfh,onsite')
                    ->orWhere('workPreference', 'onsite,wfh');
            });
        }

        return $next($query);
    }
}
