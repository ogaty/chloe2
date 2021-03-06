@extends('canvas::errors.layout')

@section('title')
    <title>{{ \Easel\Models\Settings::blogTitle() }} | Page not found</title>
@stop

@section('content')
    <div class="login-container">
        <p class="f-20 f-300 text-center">500 - Internal Server Error</p>
        <p class="text-muted text-center">Sorry, but something is wrong.</p>
        @if(Auth::guard('canvas')->check())
            <div style="text-align: center">
                <a href="{!! route('canvas.admin') !!}" class="btn btn-link m-t-10">Back to Dashboard</a>
            </div>
        @else
            <div style="text-align: center">
                <a href="{!! route('canvas.blog.post.index') !!}" class="btn btn-link m-t-10">Back to Blog</a>
            </div>
        @endif
    </div>
@stop
