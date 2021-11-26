@extends('admin.layouts.app')
@section('title', 'AR Server | لوحة التحكم')

@section('css')
    <style>
        .show-all {
            position: absolute;
            top: -6px;
            right: 25px;
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    <section class="main-part text-center">
        <div class="container">
            <h1>لوحه التحكم الرئيسيه</h1>
            <div class="row justify-content-center align-content-center">
                @php
                $role = \Auth::user()->role;
                @endphp
                @if($role == 'admin')
                    <div class="col-md-4 mb-4">
                        <div class="content">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('managers.index') }}" class="show-all">عرض الكل</a>
                                    <div class="info">
                                        عدد المشرفين
                                        <br>
                                        {{ \App\Models\Manager::count() }}
                                    </div>
                                </div>
                                <div class="col text-left">
                                    <img src="{{ asset('images/famous.svg') }}" alt="مشرف" class="judge">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($role == 'admin' || $role == 'manager')
                <div class="col-md-4 mb-4">
                    <div class="content">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('judges.index') }}" class="show-all">عرض الكل</a>
                                <div class="info">
                                    عدد القضاه
                                    <br>
                                    {{ \App\Models\Judge::count() }}
                                </div>
                            </div>
                            <div class="col text-left">
                                <img src="{{ asset('images/judge.svg') }}" alt="قاضى" class="judge">
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if( $role  == 'admin' || $role  == 'manager' ||  $role == 'judge')

                <div class="col-md-4 mb-4">
                    <div class="content">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('issues.index') }}" class="show-all">عرض الكل</a>
                                <div class="info">
                                    القضايا خلال 24 ساعه
                                    <br>
                                    {{ \App\Models\Issue::where('created_at', '>=', \Carbon\Carbon::now()->subDay())->count() }}
                                </div>
                            </div>
                            <div class="col text-left">
                                <img src="{{ asset('images/law.svg') }}" alt="القضايا" class="judge">
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <img src="https://cdn.discordapp.com/attachments/857020671280152676/857093299986890752/AR_Line.png" class="mt-5 w-100">
            <div class="row">
                <div class="col-md-12 mt-5 mb-5 mx-auto">
                    <h2 class="mb-4">
                        <i class="fa fa-user fa-spin ml-1"></i>
                        اخر 10 مطلوبين
                    </h2>
                    <div class="cont">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاى دى</th>
                                <th scope="col">الاسم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($issues as $index => $issue)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $issue->caseId }}</td>
                                <td>{{ $issue->name }}</td>
                            </tr>
                            @empty
                                <tr><td colspan="3">لا يوجد مطلوبين حتى الان....</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
