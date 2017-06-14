@extends('canvas::frontend.layout')

@if (isset($tag->title))
    @section('title', \Easel\Models\Settings::blogTitle().' | '.$tag->title)
@else
    @section('title', \Easel\Models\Settings::blogTitle().' | Blog')
@endif
@section('og-title', \Easel\Models\Settings::blogTitle())
@section('twitter-title', \Easel\Models\Settings::blogTitle())
@section('og-description', \Easel\Models\Settings::blogDescription())
@section('twitter-description', \Easel\Models\Settings::blogDescription())

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @include('canvas::frontend.blog.partials.tag')
                @include('canvas::frontend.blog.partials.posts')
                @include('canvas::frontend.blog.partials.paginate-index')
            </div>
        </div>
    </div>
@stop

@section('unique-js')
    <script src="{{ elixir('vendor/canvas/assets/js/frontend.js') }}" charset="utf-8"></script>
@endsection
