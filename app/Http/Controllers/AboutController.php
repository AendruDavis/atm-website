<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Models\TeamMember;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('about.index', [
            'teamMembers' => TeamMember::published()->with('photo')->orderBy('sort_order')->get(),
            'credentials' => Credential::query()->where('is_verified', true)->orderBy('sort_order')->get(),
        ]);
    }
}
