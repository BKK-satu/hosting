@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/information-detail.css') }}">

    <style>
        .title-page h1.fw-bold {
            margin-bottom: 60px;
        }
        /* STYLING DETAIL WRAPPER */
        .detail-outer-wrapper .header {
            border-radius: 15px 15px 0px 0px;
            height: 250px;
            background-image: linear-gradient(to right, #2e51d1, #9cb0f0);
        }
        .detail-outer-wrapper .content .prestasi div.img div {
            width: 100px;
            height: 100px;
            background-color: rgb(165, 163, 163);
        }
        .detail-outer-wrapper .content div.tools div {
            width: 30px;
            height: 30px;
            color: #fff;
        }
        .detail-outer-wrapper .content div.tools div:nth-child(1) {
            background: rgb(242, 180, 46);
        }
        .detail-outer-wrapper .content div.tools div:nth-child(2) {
            background: rgb(242, 42, 42);
        }
        .detail-outer-wrapper .content .img {
            height: 300px;
            width: 100%;
        }
        .detail-outer-wrapper .content .img .big-img div,
        .detail-outer-wrapper .content .img .small-img div {
            height: 100%;
        }
        .detail-outer-wrapper .content .img .big-img div div {
            height: 100%;
            width: 100%;
            background-color: rgb(202, 202, 202);
        }
        .detail-outer-wrapper .content .img .small-img div div {
            height: 100%;
            background-color: rgb(202, 202, 202);
        }
        .detail-outer-wrapper .content .row {
            --bs-gutter-x: 0px;
        }
    </style>
@endsection

@section('container')
    <div class="main-page">
        <!-- SIDEBAR -->
        @include('partials.sidebar-admin')

        <!-- IMAGE WAVES -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves"
            preserveAspectRatio="none">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>

        <div class="content-outer-wrapper mx-auto">
            <div class="py-3 content-wrapper">
                <!-- TITLE -->
                <div class="title-back">
                    <a href="{{ route('admin.news') }}" class="d-flex align-items-center text-decoration-none text-white"><i
                            class='bx bx-left-arrow-alt'></i>Back</a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Detail</h1>
                    <h1 class="fw-bold">Informasi</h1>
                </div>

                <!-- CONTENT -->
                <section id="content">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col">
                                <div class="detail-box">
                                    <div class="detail-cover">
                                        @if ($new->banner === 'default-informasi.jpeg' || $new->banner === null)
                                        <img src="{{ asset('/assets/img/imp/default-informasi.jpeg') }}" alt="banner">
                                        @else
                                        <img src="{{ asset('/assets/img/news/'.$new->banner) }}" alt="banner">
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <div class="info-title fs-3 fw-bold">{{ $new->title }}</div>
                                        <div class="small text-black-50 mt-3">
                                            Administrator BKK <span class="mx-2">|</span> <i class="bi-calendar"></i> {{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}
                                        </div>
                                        <div class="my-4 info-text">
                                            {!! $new->content !!}
                                        </div>
                                    </div>
                                    <div class="row g-3 justify-content-center p-3">
                                        @if ($new->image_satu === 'default-company.png')
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/imp/default-company.png') }}" alt="image_satu" style="width:250px; height:150px; ">
                                        </div>
                                        @else
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/news/'.$new->image_satu) }}" alt="image_satu" style="width:250px; height:150px; ">
                                        </div>
                                        @endif
                                        @if ($new->image_dua === 'default-company.png')
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/imp/default-company.png') }}" alt="image_dua" style="width:250px; height:150px; ">
                                        </div>
                                        @else
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/news/'.$new->image_dua) }}" alt="image_dua" style="width:250px; height:150px; ">
                                        </div>
                                        @endif
                                        @if ($new->image_tiga === 'default-company.png')
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/imp/default-company.png') }}" alt="image_dua" style="width:250px; height:150px; ">
                                        </div>
                                        @else
                                        <div class="col-3">
                                            <img src="{{ asset('/assets/img/news/'.$new->image_tiga) }}" alt="image_dua" style="width:250px; height:150px; ">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
