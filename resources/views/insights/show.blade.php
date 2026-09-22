@extends('layouts.app')
@section('title', $post->seo_title ?: $post->title.' | ATM Insights')
@section('description', $post->seo_description ?: $post->excerpt)
@section('content')
<article><header class='page-hero'><div class='shell relative z-10 max-w-5xl py-20 sm:py-28'><a class='text-xs font-black uppercase tracking-widest text-yellow-400' href='{{ route('insights.index') }}'>← All insights</a><p class='mt-8 text-xs font-black uppercase tracking-widest text-white/60'>{{ $post->category?->name ?? 'Insight' }} · {{ $post->reading_time }} min read</p><h1 class='mt-5 font-display text-4xl font-black uppercase leading-[.95] tracking-tight sm:text-6xl'>{{ $post->title }}</h1><p class='mt-7 max-w-3xl text-lg leading-8 text-white/70'>{{ $post->excerpt }}</p></div></header><div class='shell max-w-3xl py-16 sm:py-24'><div class='grid gap-6 text-lg leading-8 text-ink/75'>@foreach($post->content ?? [] as $block)<p>{{ is_array($block) ? ($block['text'] ?? '') : $block }}</p>@endforeach</div><div class='mt-12 border-t border-green-950/15 pt-6 text-sm font-bold text-green-950'>{{ $post->author?->name ?? 'ATM Surveyors & Engineering Consultants' }}</div></div></article>
@endsection
