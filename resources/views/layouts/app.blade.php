<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-lang="{{ app()->getLocale() }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Premium bilingual digital marketplace">
    <title>@yield('title','Nexora') — Nexora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@500;600;700;800&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <script>document.documentElement.dataset.theme=localStorage.getItem('nexora-theme')||'light'</script>
</head>
<body>
<header class="subnav">
    <a class="brand" href="{{ route('home') }}"><span>N</span>NEXORA</a>
    <nav><a href="{{ route('shop') }}">{{ __('ui.marketplace') }}</a><a href="{{ route('ai') }}">{{ __('ui.ai') }}</a><a href="{{ route('orders.track') }}">{{ __('ui.track') }}</a><a href="{{ route('about') }}">{{ __('ui.about') }}</a></nav>
    <div><button class="theme-toggle" id="themeToggle"><span>◐</span><b>{{ __('ui.dark') }}</b></button><a class="language-toggle" href="{{ route('language',app()->getLocale()==='ar'?'en':'ar') }}">{{ app()->getLocale()==='ar'?'EN':'العربية' }}</a><a class="navbag" href="{{ route('cart') }}">{{ __('ui.cart') }} <b>{{ array_sum(session('cart',[])) }}</b></a></div>
</header>
<div class="page-ambient"><i></i><i></i><i></i></div>
@if(session('success'))<div class="flash wrap">{{ session('success') }}</div>@endif
@yield('content')
<footer class="page-footer"><a class="brand" href="{{ route('home') }}"><span>N</span>NEXORA</a><p>{{ app()->getLocale()==='ar' ? 'أدوات رقمية. طموح إنساني. مطابقة ذكية.' : 'Digital tools. Human ambition. Intelligent matching.' }}</p><div>© {{ date('Y') }} NEXORA · {{ app()->getLocale()==='ar' ? 'الخصوصية · الشروط' : 'PRIVACY · TERMS' }}</div></footer>
<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>
