@extends('layouts.app')
@section('title', 'Survey Request Received | ATM')
@section('content')
<section class='min-h-[65svh] bg-green-950 text-white'><div class='shell flex min-h-[65svh] items-center py-20'><div class='max-w-3xl'><span class='inline-flex h-16 w-16 items-center justify-center rounded-full bg-yellow-400 text-3xl font-black text-green-950'>✓</span><p class='eyebrow mt-8 text-yellow-400'>Request received</p><h1 class='display-title mt-5'>Thank you.</h1><p class='mt-7 text-xl leading-8 text-white/75'>Your reference is <strong class='text-white'>{{ $surveyRequest->reference }}</strong>. Keep it handy when speaking with our team.</p><p class='mt-4 text-white/65'>We will review the information and contact you using the details supplied.</p><div class='mt-9 flex flex-wrap gap-3'><a class='button button-red' href='{{ route('home') }}'>Return home</a><a class='button button-outline' href='tel:+256779269784'>Call us</a></div></div></div></section>
@endsection
