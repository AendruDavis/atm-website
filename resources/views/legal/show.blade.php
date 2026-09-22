@extends('layouts.app')
@section('title', $page->seo_title ?: $page->title.' | ATM')
@section('content')
<section class='page-hero'><div class='shell relative z-10 max-w-4xl py-20'><p class='eyebrow text-yellow-400'>Legal</p><h1 class='display-title mt-6'>{{ $page->title }}</h1><p class='mt-6 text-lg leading-8 text-white/70'>{{ $page->summary }}</p></div></section><section class='bg-paper'><div class='shell max-w-3xl py-16 sm:py-24'><div class='grid gap-6 text-lg leading-8 text-ink/75'>@foreach($page->content ?? [] as $block)<p>{{ is_array($block) ? ($block['text'] ?? '') : $block }}</p>@endforeach</div></div></section>
@endsection
