@extends('layouts.app')

@section('content')
  <div id="content" class="content full padding-b0">
    <div class="container">
        <!-- Welcome Content and Services overview -->
      <div class="row">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        {{-- <a href="{{ route('register') }}">Register</a> --}}
                    @endauth
                </div>
            @endif
                {{-- <div class="top-right links">
                    <header-front/>
                </div>
                <div class="container-fluid pl-0 pr-0" style="padding-bottom: 3rem;">
                    <router-view></router-view>
                </div> --}}
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@stop