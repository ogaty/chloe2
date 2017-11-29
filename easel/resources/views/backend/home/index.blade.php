@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Easel\Models\Settings::blogTitle() }} | Home</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                @if(\Easel\Models\User::isAdmin(Auth::guard('canvas')->user()->role))
                    @include('canvas::backend.home.sections.welcome')
                @endif
                <div class="row">
                    @if(\Easel\Models\User::isAdmin(Auth::guard('canvas')->user()->role))
                        <div class="col-sm-6 col-md-6">
                            @include('canvas::backend.home.sections.at-a-glance')
                        </div>
                    @endif
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.home.sections.quick-draft')
                    </div>
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.home.sections.recent-posts')
                    </div>
                    <div class="col-sm-6 col-md-6">
                        @include('canvas::backend.home.sections.canvas-news')
                    </div>
                </div>
            </div>
        </section>
    </section>
    @include('canvas::backend.home.partials.modals.update')
@stop

@section('unique-js')
    @if(Session::get('_login'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_login'])
        {{ \Session::forget('_login') }}
    @endif
    @include('canvas::backend.shared.components.slugify')
@stop
