<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='theme-color' content='#075b35'>
    <title>@yield('title', $siteSettings?->default_seo_title ?? 'ATTM Surveyors & Engineering Consultants')</title>
    <meta name='description' content='@yield(' description', $siteSettings?->default_seo_description ?? 'Professional surveying and engineering consultancy across Uganda.')'>
    <link rel='icon' href='{{ asset('images/atm-logo.png') }}'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class='bg-cream text-ink antialiased'>
    <a class='skip-link' href='#main-content'>Skip to content</a>
    <div class='bg-green-950 text-white'>
        <div class='shell flex min-h-10 items-center justify-between gap-4 py-2 text-xs font-bold tracking-wide'>
            <p>{{ $siteSettings?->areas_served ?? 'Kampala and projects across Uganda' }}</p>
            <div class='hidden items-center gap-5 sm:flex'>
                <a href='tel:{{ preg_replace('/\s+/', '', $siteSettings?->phone ?? '+256779269784') }}'>{{ $siteSettings?->phone ?? '+256 779 269 784' }}</a>
                <a href='mailto:{{ $siteSettings?->email ?? 'info@atmconsultants.ug' }}'>{{ $siteSettings?->email ?? 'info@attmsurveyors.com' }}</a>
            </div>
        </div>
    </div>
    <header class='site-header' data-header>
        <div class='shell flex h-22 items-center justify-between gap-6'>
            <a href='{{ route('home') }}' class='flex items-center gap-3' aria-label='ATM home'>
                <img src='{{ asset('images/atm-logo.png') }}' alt='ATTM Surveyors and Engineering Consultants' class='h-18 w-18 object-contain'>
                <span class='hidden max-w-48 text-sm font-black uppercase leading-tight tracking-tight text-green-950 md:block'>Surveyors &amp;<br>Engineering Consultants</span>
            </a>
            <button class='menu-button lg:hidden' type='button' data-menu-button aria-expanded='false' aria-controls='primary-navigation'>
                <span></span><span></span><span></span><span class='sr-only'>Open menu</span>
            </button>
            <nav id='primary-navigation' class='primary-nav' data-menu aria-label='Primary navigation'>
                <a href='{{ route('home') }}' @class(['active'=> request()->routeIs('home')])>Home</a>
                <a href='{{ route('services.index') }}' @class(['active'=> request()->routeIs('services.*')])>Services</a>
                <a href='{{ route('projects.index') }}' @class(['active'=> request()->routeIs('projects.*')])>Projects</a>
                <a href='{{ route('about') }}' @class(['active'=> request()->routeIs('about')])>About</a>
                <a href='{{ route('insights.index') }}' @class(['active'=> request()->routeIs('insights.*')])>Insights</a>
                <a href='{{ route('contact.create') }}' @class(['active'=> request()->routeIs('contact.*')])>Contact</a>
                <a href='{{ route('survey-requests.create') }}' class='button button-red'>Request a survey</a>
            </nav>
        </div>
    </header>

    <main id='main-content'>@yield('content')</main>

    <footer class='bg-green-950 text-white'>
        <div class='shell grid gap-12 py-16 md:grid-cols-[1.3fr_.7fr_.7fr]'>
            <div>
                <img src='{{ asset('images/atm-logo.png') }}' alt='' class='mb-5 h-24 w-24 object-contain'>
                <p class='max-w-md text-lg font-bold'>Accuracy on the ground. Confidence in every decision.</p>
                <p class='mt-3 max-w-md text-sm leading-6 text-white/70'>{{ $siteSettings?->company_description ?? 'Professional surveying and engineering consultancy for land, property and infrastructure.' }}</p>
            </div>
            <div>
                <h2 class='footer-title'>Explore</h2>
                <div class='mt-5 grid gap-3 text-sm text-white/75'>
                    <a href='{{ route('services.index') }}'>Services</a><a href='{{ route('projects.index') }}'>Projects</a><a href='{{ route('about') }}'>About ATM</a><a href='{{ route('contact.create') }}'>Contact</a>
                </div>
            </div>
            <div>
                <h2 class='footer-title'>Talk to us</h2>
                <div class='mt-5 grid gap-3 text-sm text-white/75'>
                    <a href='tel:{{ preg_replace('/\s+/', '', $siteSettings?->phone ?? '+256779269784') }}'>{{ $siteSettings?->phone ?? '+256 779 269 784' }}</a>
                    <a href='https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings?->whatsapp ?? '+256703063147') }}'>WhatsApp {{ $siteSettings?->whatsapp ?? '+256 703 063 147' }}</a>
                    <span>{{ $siteSettings?->office_address ?? 'Kampala, Uganda' }}</span>
                </div>
            </div>
        </div>
        <div class='border-t border-white/10'>
            <div class='shell flex flex-col gap-3 py-5 text-xs text-white/55 sm:flex-row sm:items-center sm:justify-between'>
                <p>&copy; {{ now()->year }} ATTM Surveyors &amp; Engineering Consultants.</p>
                <div class='flex gap-5'><a href='{{ route('legal.show', 'privacy-policy') }}'>Privacy</a><a href='{{ route('legal.show', 'terms-of-service') }}'>Terms</a></div>
            </div>
        </div>
    </footer>
</body>

</html>