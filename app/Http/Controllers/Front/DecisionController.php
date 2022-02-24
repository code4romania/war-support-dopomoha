<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Decision;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\View\View;

class DecisionController extends Controller
{
    use SEOTools;

    public function index(): View
    {
        return view('front.decisions.index', [
            'decisions' => Decision::query()
                ->paginate(),
        ]);
    }

    public function show(string $locale, Decision $decision): View
    {
        $this->seo()
            ->setTitle($decision->title)
            ->setDescription($decision->description);

        return view('front.decisions.show', [
            'decision' => $decision,
        ]);
    }
}
