@extends('layouts.app')
@section('title', 'AR Server | فحص اللاعبين')
@section('css')
    <link href="{{ asset("css/venobox.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/simple-lightbox.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .gallery {
            padding: 10px 0;
            margin: 10px 0;
            box-shadow: 2px 2px 6px 1px #888888;
        }
        .sl-wrapper {z-index: 99999999 !important}
        .sl-overlay {z-index: 99999998 !important}
    </style>
@endsection
@section('content')

@include('partials.waves')
@include('partials.navbar')
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    ---------------------------------------------Start done section   ------------------------------------------
    ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<div class="done mb-5">
    <div class="container">
        <h1 class="title">     الكشف عن حالة اللاعب </h1>
        <img src="{{ asset('images/search.svg') }}" alt="search" class="vector-img mt-4 mb-5">
        <form class="dis text-center" id="check_player" action="{{ route('check-players.search') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="ال اى دى الخاص بالاعب" id="caseId" name="caseId">
                <input class="d-block btn btn-block btn-secondary mt-2" value="  بحث" type="submit">

            </div>
        </form>
        <div class="dis" id="result">

        </div>
    </div>
</div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
---------------------------------------------End done section ------------------------------------------
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
@endsection
@section('js')
    <script src="{{ asset('js/simple-lightbox.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#check_player').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let dis = $('#result');

            $.ajax({
                type:'POST',
                url: "{{ route('check-players.search') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response.status === true) {
                        let images = JSON.parse(response.data.evidences)
                        let successResult = `
                        <div class="content">
                            <p class="lead">عمليه بحث ناجحه</p>
                            <div class="row ">
                                <div class="col text-left">
                                    الأسم :
                                </div>
                                <div class="col text-right">
                                    ${response.data.name}
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col text-left">
                                    الأيدى :
                                </div>
                                <div class="col text-right">
                                    ${response.data.caseId}
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col text-left">
                                    الحاله :
                                </div>
                                <div class="col text-right">
                                    ${response.data.status}
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col col-12">
                                    الدلائل :
                                </div>
                                <div class="col-12 text-right">
                                <div class="gallery">
                                    ${images.map((image, index) => `

                                            <a href="${window.location.origin + '/' + image}" target="_blank">
                                                <img src="${window.location.origin + '/' + image}"
                                                     alt="الدليل رقم : ${index +1}"
                                                     height="100" width="100">
                                            </a>

                                    `).join("")}
                                </div>
                                </div>
                            </div>
                        </div>`;
                        dis.html(successResult)
                        let lightbox = new SimpleLightbox('.gallery a', {});
                    } else {
                        let errorResult = `
                        <div class="content">
                              <p class="lead">عمليه بحث فاشله</p>
                              <img src="{{ asset('images/not-found_1.png') }}" alt="not-found">
                              <p class="mt-5 mb-0">رجاء التحقق من الأى دى و اعاده المحاوله</p>
                          </div>
                        `;
                        dis.html(errorResult)
                    }
                },
            })
        })
    </script>
@endsection
