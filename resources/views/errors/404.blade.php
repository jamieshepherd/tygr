@extends('_layout.base')
@section('headlinks')
<!--script src="/js/your-custom-javascript.js"></script-->
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main" class="error-status">
        @include('_layout.header')
        <div class="oh-no"><i class="fa fa-thumbs-o-down"></i></div>
        <h1>404</h1>
        <h2>Page not found.</h2>
        <p>Sorry, we couldn't find that page. If it's a dead link, <a href="mailto:email@jamie.sh">we'd like to know</a>. Otherwise, you can use the navigation to the left to find what you were looking for.</p>
    </div>
@stop
