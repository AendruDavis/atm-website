@extends('layouts.app')
@section('title', 'Surveying & Engineering Services | ATM Uganda')
@section('content')
<section class='page-hero'><div class='shell relative z-10 py-20 sm:py-28'><p class='eyebrow text-yellow-400'>Our services</p><h1 class='display-title mt-6 max-w-4xl'>Technical clarity<br>for every site.</h1><p class='mt-7 max-w-2xl text-lg leading-8 text-white/70'>Integrated surveying, valuation, spatial and environmental expertise for landowners, developers and project teams.</p></div></section>
<section class='bg-paper py-20 sm:py-28'><div class='shell'>
    @forelse($services as $service)
        <a class='service-row reveal group' href='{{ route('services.show', $service) }}'><span class='service-number'>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><p class='mb-2 text-xs font-bold uppercase tracking-widest text-green-700'>{{ $service->eyebrow ?? 'ATM expertise' }}</p><h2 class='font-display text-3xl font-black uppercase tracking-tight text-green-950 sm:text-4xl'>{{ $service->title }}</h2></div><p class='max-w-lg text-sm leading-6 text-ink/65'>{{ $service->summary }}</p><span class='service-arrow text-2xl'>→</span></a>
    @empty
        <p class='py-16 text-center text-ink/60'>Services are being prepared. Please contact us for current capabilities.</p>
    @endforelse
</div></section>
<section class='bg-yellow-400'><div class='shell flex flex-col gap-7 py-12 sm:flex-row sm:items-center sm:justify-between'><h2 class='font-display text-4xl font-black uppercase tracking-tight text-green-950'>Not sure which survey you need?</h2><a class='button bg-green-950 text-white' href='{{ route('contact.create') }}'>Talk to a surveyor →</a></div></section>
@endsection
