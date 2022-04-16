@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
    <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">

    <style>
        .title-page h1.fw-bold {
            margin-bottom: 60px;
        }
        .dropdown-menu {
            min-width: 0px;
        }
        .page-item:first-child .page-link {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        /* STYLING NEWS */
        .content .news .header {
            height: 150px;
            border-radius: 15px 15px 0px 0px;
            background-image: linear-gradient(to right, #2145c5, #7a92e4);
        }
        .content .news .header .tools {
            /* transition: 0.3s; */
            visibility: hidden;
        }
        .content .news .header:hover .tools {
            transition: 0.3s;
            visibility: visible;
            background: #7a92e4;
        }
        .content .news .header .tools a,
        .content .news .header .tools span {
            cursor: pointer;
            font-size: 26px;
        }
        .content .news .header .tools span i.bx,
        .content .news .header .tools a i.bx {
            line-height: 0px;
        }
        .content .news .content div {
            font-size: 14px;
        }
        .content.row {
            --bs-gutter-x: 0px;
        }
    </style>
@endsection
@section('container')
<div class="main-page">
    <!-- SIDEBAR -->
    @include('partials.sidebar-admin')

    <!-- BG WAVES -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves"
        preserveAspectRatio="none">
        <path fill="#0099ff" fill-opacity="1"
            d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
        </path>
    </svg>

    <div class="content-outer-wrapper mx-auto">
        <div class="py-3 content-wrapper">
            <!-- TITLE -->
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Daftar</h1>
                <h1 class="fw-bold">Informasi</h1>
            </div>

            <div class="alumni-table">
                <!-- SEARCH INPUT -->
                <div class="search py-3 me-2">
                    <form action="" class="position-relative d-flex justify-content-center">
                        <div class="input-group mb-3">
                            <button class="input-group-text btn-search"><i class='bx bx-search'></i></button>
                            <input type="text" class="form-control" placeholder="Search Pelamar..."
                                aria-label="search" name="q">
                        </div>
                    </form>
                </div>
                <div class="data-table rounded-20 p-2">
                    <!-- TOMBOL DIATAS DATA NEWS -->
                    <div class="header d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary rounded-15"><i
                                class='bx bxs-plus-circle align-middle'></i>
                            <p class="d-inline align-middle">Add</p>
                        </a>
                    </div>
                    <!-- DAFTAR NEWS ITEM -->
                    @if (\Session::has('msg'))
                        <div>
                            <div class="alert alert-success" role="alert">
                                {!! \Session::get('msg') !!}
                            </div>
                        </div>
                        @endif
                    <div class="content mb-3 row">
                        @foreach ($data_informasi as $new)
                        <div class="col-12 col-lg-4 col-sm-6">
                            {{-- <div class="news p-2">
                                <div class="shadow rounded-20 bg-white">
                                    <div class="tools p-1 rounded-15">
                                        <a href="{{ route('admin.news.edit', $new->id_informasi) }}" class="text-decoration-none text-white me-2 p-2"><i
                                                class='bx bxs-edit align-middle'></i></a>
                                        <span href="#" onclick="swalDelete($new->id_informasi)"
                                            class="text-decoration-none text-white p-2"><i
                                                class='bx bxs-trash-alt align-middle'></i></>
                                    </div>
                                    <div class="info-cover">
                                        @if ($new->banner == 'default-informasi.jpeg')
                                        <img src="{{ asset('/assets/img/imp/default-informasi.jpeg') }}" alt="banner" class="img-fluid">
                                        @else
                                        <img src="{{ asset('/assets/img/news/'. $new->banner) }}" alt="banner" class="img-fluid">
                                        @endif
                                    </div>
                                    <a href="{{ route('bkk.informtiona.detail', $new->slug) }}" class="p-3 judul-info fw-bold text-black text-decoration-none">
                                        {{ $new->title }}
                                    </a>
                                    <div class="row p-3 text-black-50">
                                        <div class="col">
                                            <div class="small">Administrator BKK</div>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <div class="small"><i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="news p-2">
                                <div class="shadow rounded-20 bg-white">
                                    <div class="header d-flex justify-content-center align-items-center">
                                        <div class="tools p-1 rounded-15">
                                            <a href="{{ route('admin.news.edit', $new->slug) }}" class="text-decoration-none text-white me-2 p-2"><i
                                                    class='bx bxs-edit align-middle'></i></a>
                                            <span href="#" onclick="swalDelete($new->id_informasi)"
                                                class="text-decoration-none text-white p-2"><i
                                                    class='bx bxs-trash-alt align-middle'></i></>
                                        </div>
                                    </div>
                                    <div class="content p-3">
                                        <a href="{{ route('admin.news.detail', $new->slug) }}" class="text-decoration-none text-link-black">
                                            <p class="fw-bold">{{ $new->title }}</p>
                                        </a>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-1 text-muted   ">Administrator BKK</p>
                                            <p class="d-flex justify-content-center align-items-center mb-1"><i
                                                    class='bx bx-calendar me-1'></i>{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- PAGINASI NEWS -->
                    </div>
                    <nav class="d-flex justify-content-end">
                        <ul class="pagination rounded-20">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class='bx bx-chevron-left align-middle'></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class='bx bx-chevron-right align-middle'></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- SWEETALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function swalDelete() {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: [true, 'Delete'],
                dangerMode: true
            })
        }
    </script>
@endsection
