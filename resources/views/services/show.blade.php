@extends('layouts.app')
@section('title', $service->seo_title ?: $service->title.' | ATM')
@section('description', $service->seo_description ?: $service->summary)
@section('content')
<section class='page-hero'><div class='shell relative z-10 py-20 sm:py-28'><a class='text-xs font-black uppercase tracking-widest text-yellow-400' href='{{ route('services.index') }}'>← All services</a><h1 class='display-title mt-7 max-w-5xl'>{{ $service->title }}</h1><p class='mt-7 max-w-2xl text-lg leading-8 text-white/70'>{{ $service->summary }}</p></div></section>
<section class='bg-paper py-20 sm:py-28'><div class='shell grid gap-14 lg:grid-cols-[1.15fr_.85fr] lg:gap-24'>
    <div class='reveal'><p class='eyebrow text-green-800'>How we help</p><div class='mt-7 grid gap-5 text-lg leading-8 text-ink/70'>@foreach($service->description ?? [$service->summary] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</div></div>
    <aside class='reveal border-l-4 border-red-600 bg-cream p-7 sm:p-10'><h2 class='font-display text-2xl font-black uppercase text-green-950'>Typical deliverables</h2><ul class='mt-6 grid gap-4'>@foreach($service->deliverables ?? [] as $item)<li class='flex gap-3 border-b border-green-950/10 pb-4'><span class='font-black text-red-600'>✓</span><span>{{ $item }}</span></li>@endforeach</ul></aside>
</div></section>
<section class='bg-green-900 py-16 text-white'><div class='shell flex flex-col gap-8 sm:flex-row sm:items-center sm:justify-between'><div><p class='text-xs font-black uppercase tracking-widest text-yellow-400'>Ready to plan the fieldwork?</p><h2 class='mt-2 font-display text-4xl font-black uppercase'>Request this service.</h2></div><a class='button button-red' href='{{ route('survey-requests.create', ['service' => $service->id]) }}'>Start request →</a></div></section>
@endsection
