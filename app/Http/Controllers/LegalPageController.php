<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class LegalPageController extends Controller
{
    public function show(Page $page): View
    {
        abort_unless(Page::published()->whereKey($page->getKey())->exists(), 404);

        return view('legal.show', compact('page'));
    }
}
