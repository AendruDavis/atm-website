<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'services' => Service::published()->orderBy('sort_order')->orderBy('id')->limit(6)->get(),
            'testimonials' => Testimonial::published()->orderByDesc('is_featured')->orderBy('sort_order')->limit(3)->get(),
        ]);
    }
}
