{!! '<'.'?xml version=1.0 encoding=UTF-8?>' !!}
    <urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>
        @foreach([route('home'), route('about'), route('services.index'), route('projects.index'), route('insights.index'), route('contact.create'), route('survey-requests.create')] as $url)<url>
            <loc>{{ $url }}</loc>
        </url>@endforeach
        @foreach($services as $service)<url>
            <loc>{{ route('services.show', $service) }}</loc>
            <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
        </url>@endforeach
        @foreach($projects as $project)<url>
            <loc>{{ route('projects.show', $project) }}</loc>
            <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
        </url>@endforeach
        @foreach($posts as $post)<url>
            <loc>{{ route('insights.show', $post) }}</loc>
            <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        </url>@endforeach
    </urlset>