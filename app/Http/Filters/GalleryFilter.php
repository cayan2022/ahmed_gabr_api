<?php

namespace App\Http\Filters;

class GalleryFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'title'
    ];

    /**
     * Filter the query by a given name.
     *
     * @param  string|int  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder
                ->when(
                    $this->request->filled('title'),
                    function ($query) use ($value) {
                        $query->whereTranslationLike('title','%'.$value.'%')
                        ->orWhereTranslationLike('description','%'.$value.'%');
                    }
                );
        }

        return $this->builder;
    }
}
