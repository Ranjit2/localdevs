<?php 
namespace App\Http\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class DevFilter extends Filter
{
    public function handle(Builder $query, Closure $next)
    {
        if (array_key_exists('dev', $this->request->filters) && $this->request->filters['dev']) {
            $query->where('expertise', $this->request->filters['dev']);
        }

        return $next($query);
    }
}
