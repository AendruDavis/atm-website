<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        return response()
            ->view('sitemap', [
                'services' => Service::published()->get(['slug', 'updated_at']),
                'projects' => Project::published()->get(['slug', 'updated_at']),
                'posts' => Post::published()->get(['slug', 'updated_at']),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
