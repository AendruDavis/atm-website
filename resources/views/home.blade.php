@extends('layouts.app')

@section('title', 'ATM Surveyors & Engineering Consultants | Uganda')
@section('description', 'Accurate cadastral, engineering and topographic surveys, property valuation, GIS and environmental consultancy across Uganda.')

@section('content')
<section class='relative min-h-[calc(100svh-7.75rem)] overflow-hidden bg-green-950 text-white'>
    <img src='{{ asset('images/surveying-hero.png') }}' alt='A professional surveyor operating a total station on a Ugandan development site' class='absolute inset-0 h-full w-full object-cover object-[63%_center]'>
    <div class='absolute inset-0 bg-[linear-gradient(90deg,rgba(4,37,24,.96)_0%,rgba(4,37,24,.82)_38%,rgba(4,37,24,.15)_76%)]'></div>
    <div class='shell relative flex min-h-[calc(100svh-7.75rem)] items-end py-14 sm:items-center sm:py-20'>
        <div class='max-w-2xl'>
            <p class='eyebrow mb-6 animate-[fade-up_.7s_ease_both] text-yellow-400'>Surveyors &amp; engineering consultants</p>
            <h1 class='display-title animate-[fade-up_.8s_.08s_ease_both]'>Measure with<br><span class='text-yellow-400'>confidence.</span></h1>
            <p class='mt-7 max-w-xl animate-[fade-up_.8s_.16s_ease_both] text-base leading-7 text-white/80 sm:text-lg'>Field-led expertise for land, property and infrastructure—from the first boundary point to the final professional report.</p>
            <div class='mt-9 flex animate-[fade-up_.8s_.24s_ease_both] flex-wrap gap-3'>
                <a class='button button-red' href='{{ route('survey-requests.create') }}'>Request a survey <span aria-hidden='true'>→</span></a>
                <a class='button button-outline' href='{{ route('services.index') }}'>Explore services</a>
            </div>
        </div>
    </div>
    <div class='absolute bottom-0 right-0 hidden bg-yellow-400 px-8 py-5 text-green-950 lg:block'>
        <p class='text-xs font-black uppercase tracking-[.16em]'>Serving clients across Uganda</p>
    </div>
</section>

<section class='bg-paper py-20 sm:py-28'>
    <div class='shell'>
        <div class='grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-24'>
            <div class='reveal'>
                <p class='eyebrow text-green-800'>What we do</p>
                <h2 class='section-title mt-5 text-green-950'>From field data<br>to clear decisions.</h2>
            </div>
            <div class='reveal lg:pt-8'>
                @forelse($services as $service)
                    <a class='service-row group' href='{{ route('services.show', $service) }}'>
                        <span class='service-number'>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class='font-display text-2xl font-black uppercase tracking-tight text-green-950 sm:text-3xl'>{{ $service->title }}</h3>
                        <p class='text-sm leading-6 text-ink/65'>{{ $service->summary }}</p>
                        <span class='service-arrow text-2xl' aria-hidden='true'>→</span>
                    </a>
                @empty
                    @foreach(['Engineering Surveying', 'Topographic Surveying', 'Cadastral Surveying', 'Land & Property Valuation', 'GIS & Remote Sensing', 'Environmental Consultancy'] as $service)
                        <a class='service-row group' href='{{ route('services.index') }}'><span class='service-number'>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3 class='font-display text-2xl font-black uppercase tracking-tight text-green-950 sm:text-3xl'>{{ $service }}</h3><p class='text-sm leading-6 text-ink/65'>Measured carefully. Explained clearly. Delivered for action.</p><span class='service-arrow text-2xl'>→</span></a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </div>
</section>

<section class='overflow-hidden bg-green-900 text-white'>
    <div class='grid lg:grid-cols-2'>
        <div class='relative min-h-[28rem] lg:min-h-[42rem]'>
            <img src='{{ asset('images/surveying-hero.png') }}' alt='' class='absolute inset-0 h-full w-full object-cover object-right'>
        </div>
        <div class='reveal flex items-center px-6 py-16 sm:px-14 lg:px-20'>
            <div class='max-w-xl'>
                <p class='eyebrow text-yellow-400'>Why ATM</p>
                <h2 class='section-title mt-5'>Precision that stands up in the real world.</h2>
                <p class='mt-7 text-lg leading-8 text-white/75'>Good surveying is more than coordinates. It is sound judgement, careful fieldwork and a report that helps every stakeholder move forward.</p>
                <div class='mt-10 grid gap-px bg-white/15 sm:grid-cols-3'>
                    <div class='bg-green-900 p-5'><strong class='block text-3xl text-yellow-400'>01</strong><span class='mt-2 block text-xs font-bold uppercase tracking-wider'>Listen first</span></div>
                    <div class='bg-green-900 p-5'><strong class='block text-3xl text-yellow-400'>02</strong><span class='mt-2 block text-xs font-bold uppercase tracking-wider'>Measure well</span></div>
                    <div class='bg-green-900 p-5'><strong class='block text-3xl text-yellow-400'>03</strong><span class='mt-2 block text-xs font-bold uppercase tracking-wider'>Report clearly</span></div>
                </div>
                <a class='button button-light mt-10' href='{{ route('about') }}'>Meet ATM <span aria-hidden='true'>→</span></a>
            </div>
        </div>
    </div>
</section>

@if($testimonials->isNotEmpty())
<section class='bg-cream py-20 sm:py-28'>
    <div class='shell reveal text-center'>
        <p class='eyebrow text-green-800'>Client perspective</p>
        <blockquote class='mx-auto mt-8 max-w-4xl font-display text-3xl font-black leading-tight text-green-950 sm:text-5xl'>“{{ $testimonials->first()->testimonial }}”</blockquote>
        <p class='mt-7 text-sm font-bold uppercase tracking-wider text-ink/55'>{{ $testimonials->first()->client_name }}@if($testimonials->first()->organization), {{ $testimonials->first()->organization }}@endif</p>
    </div>
</section>
@endif

<section class='bg-red-600 text-white'>
    <div class='shell flex flex-col gap-8 py-14 sm:flex-row sm:items-center sm:justify-between'>
        <div><p class='text-xs font-black uppercase tracking-[.16em] text-yellow-400'>Have a site or boundary question?</p><h2 class='mt-2 font-display text-4xl font-black uppercase tracking-tight sm:text-5xl'>Let’s put certainty on the map.</h2></div>
        <a class='button button-light shrink-0' href='{{ route('survey-requests.create') }}'>Start your request <span aria-hidden='true'>→</span></a>
    </div>
</section>
@endsection
