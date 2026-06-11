@extends('layouts.app')

@section('title', __('legal.mentions_meta_title'))

@section('meta')
<meta name="description" content="{{ __('legal.mentions_meta_desc') }}">
@endsection

@section('content')
<div class="min-h-screen text-white" style="background-color: var(--bff-bg-dark);">

    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-16 sm:py-24">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-[#7388a6] mb-10" style="font-family: 'Poppins', sans-serif;">
            <a href="{{ route('home') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.home') }}</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60">{{ __('legal.mentions_breadcrumb') }}</span>
        </nav>

        {{-- Header --}}
        <div class="mb-14">
            <div class="w-10 h-1 bg-[#ffdc21] rounded-full mb-6"></div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black uppercase tracking-tight mb-4" style="font-family: 'Poppins', sans-serif;">
                {!! __('legal.mentions_title') !!}
            </h1>
            <p class="text-sm text-[#b2c0d9] font-light" style="font-family: 'Poppins', sans-serif;">
                {{ __('legal.last_updated') }} : {{ now()->translatedFormat('d F Y') }}
            </p>
        </div>

        {{-- Content --}}
        <div class="space-y-12 text-sm text-[#b2c0d9] font-light leading-relaxed" style="font-family: 'Poppins', sans-serif;">
            @include('legal.' . app()->getLocale() . '.mentions-legales')
        </div>
    </main>
</div>
@endsection
