<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    use SEOTools;

    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'query' => ['required', 'string', 'min:3'],
        ]);

        $attributes['type'] ??= 'page';

        $attributes['query'] = Str::of($attributes['query'])
            ->stripTags()
            ->explode(' ')
            ->reject(fn (string $term) => Str::length($term) < 3)
            ->join(' ');

        $this->seo()
            ->setTitle(__('app.search.results', ['query' => $attributes['query']]));

        return response()
            ->view('front.search.results', [
                'query' => $attributes['query'],
                'items' => $this->search($attributes['query'], $attributes['type']),
            ])
            ->header('x-robots-tag', 'noindex');
    }

    protected function search(string $query, string $model): LengthAwarePaginator
    {
        return Page::query()
            ->search($query)
            ->paginate(
                perPage: 20
            );
    }
}
