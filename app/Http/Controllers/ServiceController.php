<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'services' => Service::published()->with('image')->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless(Service::published()->whereKey($service->getKey())->exists(), 404);

        return view('services.show', ['service' => $service->load('image')]);
    }
}
