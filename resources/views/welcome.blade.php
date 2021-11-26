@extends('layouts.app')
@section('title', 'AR Server | الصفحة الرئيسية')
@section('css')
    <link href="{{ asset("css/particles.css") }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    ---------------------------------------------Start online section  ------------------------------------------
    ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
@include('partials.waves')
@include('partials.navbar')
<div class="online">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
        </div>
        <div class="Inneronline">
            <svg height="65" width="100" class="blinking">
                <circle cx="50" cy="32" r="10" fill="#F14158" />
                Sorry, your browser does not support inline SVG.
            </svg>
            <span>السيرفر متصل الأن</span>
        </div>
        <h1 class="title">AR-Protection   </h1>
        <img src="https://media.discordapp.net/attachments/794317246583144468/858317482011394068/standard_1.gif" alt="gif" class="gif mt-5">
    </div>
</div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
---------------------------------------------end online section  ------------------------------------------
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
---------------------------------------------Start online player list  ------------------------------------------
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

<div class="online-list text-center">
    <h2 class="white">       تعرف على الطاقم الادارى      </h2>
    <section class="caracters text-center">
        <div class="container">
            <div class="row align-content-center justify-content-center">
                @foreach(\App\User::all() as $admin)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="content">
                        <div >
                            <img src="{{ renderImage($admin->image) }}" alt="{{ $admin->first_name . ' ' . $admin->last_name}}">
                            <h1 class="name">{{ $admin->first_name . ' ' . $admin->last_name}}</h1>
                            <p class="rank">{{ $admin->role }}</p>
                            <ul class="list-unstyled m-0 p-0">
                                @if($admin->facebook_link)
                                <li class="d-inline-block">
                                    <a href="{{ $admin->facebook_link }}" target="_blank" rel="nofollow">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                @endif

                                @if($admin->twitter_link)
                                <li class="d-inline-block">
                                    <a href="{{ $admin->twitter_link }}" target="_blank" rel="nofollow">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                @endif

                                @if($admin->instagram_link)
                                <li class="d-inline-block">
                                    <a href="{{ $admin->instagram_link }}" target="_blank" rel="nofollow">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
---------------------------------------------end online player list   ------------------------------------------
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
@endsection('content')
