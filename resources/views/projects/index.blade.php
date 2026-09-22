@extends('layouts.app')
@section('title', 'Selected Projects | ATM Surveyors Uganda')
@section('content')
<section class='page-hero'><div class='shell relative z-10 py-20 sm:py-28'><p class='eyebrow text-yellow-400'>Selected work</p><h1 class='display-title mt-6'>Evidence in<br>the field.</h1><p class='mt-7 max-w-2xl text-lg leading-8 text-white/70'>A selection of surveying and engineering assignments delivered for land, property and infrastructure decisions.</p></div></section>
<section class='bg-paper py-20 sm:py-28'><div class='shell grid gap-x-8 gap-y-14 md:grid-cols-2 lg:grid-cols-3'>
    @forelse($projects as $project)
        <article class='reveal group'><a href='{{ route('projects.show', $project) }}' class='block'><div class='aspect-[4/3] overflow-hidden bg-green-950'><img src='{{ $project->featuredImage?->url ?? asset('images/surveying-hero.png') }}' alt='' class='h-full w-full object-cover transition duration-500 group-hover:scale-105'></div><p class='mt-5 text-xs font-black uppercase tracking-widest text-red-600'>{{ $project->location ?? 'Uganda' }} · {{ $project->project_type }}</p><h2 class='mt-2 font-display text-3xl font-black uppercase leading-none tracking-tight text-green-950'>{{ $project->title }}</h2><p class='mt-4 text-sm leading-6 text-ink/65'>{{ $project->overview }}</p></a></article>
    @empty
        <div class='md:col-span-2 lg:col-span-3'><p class='text-center text-ink/60'>Project case studies are being prepared. Contact us to discuss relevant experience.</p></div>
    @endforelse
</div><div class='shell mt-12'>{{ $projects->links() }}</div></section>
@endsection
