<!DOCTYPE html>
<html>
<head>
    <title>@if(isset($title)) {{ $title }} - @endif Review Log - Sponge UK</title>
    <script src="//use.typekit.net/mwm5nzt.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>

    <link rel="shortcut icon" href="{{ Request::root() }}/favicon.ico"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{ elixir("css/main.css") }}">
    <link media="all" type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
    <script src="/js/respond.min.js"></script>
    <script src="/js/helpers.js"></script>
    @yield('headlinks')
</head>
@yield('body')
@include('_layout.footer')
