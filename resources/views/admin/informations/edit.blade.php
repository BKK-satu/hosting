@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Admin')

@section('css')
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <!-- TEXTAREA EDITOR -->
    <script src="{{ asset('/assets/js/ckeditor.js') }}"></script>

    <style>
        /* STYLING TITLE PAGE */
        .title-page h1.fw-bold {
            margin-bottom: 120px;
        }
        /* WRAPPER FORM */
        .edit-wrapper .data form {
            width: 50vw;
        }
        .edit-wrapper .data form .btn-action button {
            width: 100px;
        }
        .edit-wrapper .preview {
            width: 45vw;
        }
        .edit-wrapper .preview .content table {
            width: 100%;
        }
        .edit-wrapper .preview .header {
            border-radius: 15px 15px 0px 0px;
            width: 100%;
            background-image: linear-gradient(to right, #96aeff, #3759d6);
            height: 200px;
        }
        /* STYLING CUSTOM FILE INPUT */
        .edit-wrapper .data .image {
            background: rgb(187, 187, 187);
            width: 100px;
            height: 100px;
        }
        .edit-wrapper .data .image #uploadPhoto {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
        .edit-wrapper .data .image label {
            z-index: 10;
            width: 100%;
            height: 100%;
            cursor: pointer;
            color: #fff;
            font-size: 60px;
            top: 10px;
            left: 0;
        }
        /* STYLING TEXTAREA EDITOR */
        :root {
            --ck-border-radius: 5px;
        }
        .edit-wrapper .data .image:hover .upload-image {
            visibility: visible;
        }
    </style>
@endsection

@section('container')
    <div class="main-page">
        <!-- SIDEBAR -->
        @include('partials.sidebar-admin')

        <img src="{{ asset('/assets/img/wave2.svg') }}" class="position-absolute waves">

        <div class="content-outer-wrapper mx-auto">
            <div class="container py-3 content-wrapper">
                <!-- TITLE HALAMAN -->
                <div class="title-back">
                    <a href="{{ route('admin.news.detail', $new->slug) }}" class="d-flex align-items-center text-decoration-none text-white"><i
                            class='bx bx-left-arrow-alt'></i>Back</a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Ubah</h1>
                    <h1 class="fw-bold">Informasi</h1>
                </div>

                <!-- KONTEN LUAR -->
                <div class="edit-wrapper d-flex">
                    <div class="data me-4">
                        <!-- DATA INPUTAN -->
                        <h2 class="fw-700 mb-2">Data</h2>
                        <form action="{{ route('admin.news.update', $new->id_informasi) }}" method="POST" class=""  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="admin_id" value="{{ $admin->id_admin }}">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control rounded-15" id="title" placeholder="Title..."
                                    onkeyup="updateTitle(this.value)" name="title" value="{{ $new->title ? $new->title : old($new->title) }}">
                            </div>
                            <div class="">
                                <label for="banner" class="form-label" id="bannerLabel">Banner</label>
                                <input type="file" class="form-control rounded-15" id="bannerImg" value="{{ $new->banner }}">
                                @if ($new->banner === 'default-informasi.jpeg' || $new->banner === null)
                                <div class="" id="imgbannerPrev"><img src="{{ asset('/assets/img/imp/default-informasi.jpeg') }}" class="w-100 rounded-20" id="bannerPrev" draggable="false"></div>
                                @else
                                <div class="" id="imgbannerPrev"><img src="{{ asset('/assets/img/informasi/'. $new->banner) }}" class="w-100 rounded-20" id="bannerPrev" draggable="false"></div>
                                @endif
                            </div>
                            <div class="my-3">
                                <label class="form-label">Foto</label>
                                <div class="d-flex">
                                    <div class="image rounded-20 text-center overflow-hidden position-relative me-1">
                                        @if ($new->image_satu === null)
                                        <img src="{{ asset('/assets/img/imp/default-company.png') }}" id="imagePreview1" width="100" draggable="false">
                                        @else
                                        <img src="{{ asset('/assets/img/informasi' . $new->image_satu) }}" id="imagePreview1" width="100" draggable="false">
                                        @endif
                                        <div class="upload-image" id="uploadImage1">
                                            <label for="uploadPhoto1" id="labelPhoto1" class="position-absolute"><i
                                                    class='bx bxs-image-add'></i></label>
                                            <input type="file" name="photo1" id="uploadPhoto1" accept="image/*"
                                                class="d-none">
                                        </div>
                                    </div>
                                    <div class="image rounded-20 text-center overflow-hidden position-relative me-1">
                                        @if ($new->image_dua === null)
                                        <img src="{{ asset('/assets/img/imp/default-company.png') }}" id="imagePreview1" width="100" draggable="false">
                                        @else
                                        <img src="{{ asset('/assets/img/informasi' . $new->image_dua) }}" id="imagePreview1" width="100" draggable="false">
                                        @endif
                                        <div class="upload-image" id="uploadImage2">
                                            <label for="uploadPhoto2" id="labelPhoto2" class="position-absolute"><i
                                                    class='bx bxs-image-add'></i></label>
                                            <input type="file" name="photo2" id="uploadPhoto2" accept="image/*"
                                                class="d-none">
                                        </div>
                                    </div>
                                    <div class="image rounded-20 text-center overflow-hidden position-relative">
                                        @if ($new->image_tiga === null)
                                        <img src="{{ asset('/assets/img/imp/default-company.png') }}" id="imagePreview1" width="100" draggable="false">
                                        @else
                                        <img src="{{ asset('/assets/img/informasi' . $new->image_tiga) }}" id="imagePreview1" width="100" draggable="false">
                                        @endif
                                        <div class="upload-image" id="uploadImage3">
                                            <label for="uploadPhoto3" id="labelPhoto3" class="position-absolute"><i
                                                    class='bx bxs-image-add'></i></label>
                                            <input type="file" name="photo3" id="uploadPhoto3" accept="image/*"
                                                class="d-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <!-- EDITOR CK EDITOR 5 -->
                                <label for="editor" class="mb-2">Konten</label>
                                <textarea name="content" id="editor">&lt;p&gt;{{ $new->content ? $new->content : old($new->content) }}&lt;/p&gt;</textarea>
                            </div>
                            <!-- <div class="blue-line rounded-20 mb-3"></div> -->
                            <div class="d-flex justify-content-end btn-action">
                                <button class="btn btn-secondary fw-700 rounded-15 me-2">Cancel</button>
                                <button class="btn btn-primary fw-700 rounded-15">Save</button>
                            </div>
                    </div>
                    <!-- HASIL PREVIEW -->
                    <div class="preview">
                        <h2 class="fw-700 mb-2">Preview</h2>
                        <div class="shadow bg-white rounded-20">
                            <div class="header mb-1 overflow-hidden">
                                <div class="">
                                    <img src="" class="w-100" id="imgPreview" draggable="false">
                                </div>
                            </div>
                            <div class="content p-3">
                                <div>
                                    <h4 class="fw-bold" id="title_value">{{ $new->title }}</h4>
                                </div>
                                <table class="mt-4">
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Author</p>
                                                <p id="kategori_value">Administrator BKK</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Dibuat</p>
                                                <p id="created_date_value">{{\Carbon\Carbon::now('Asia/Jakarta')->diffForHumans()}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // MANGGIL CK EDITOR
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        // BANNER
        bannerImg.onchange = evt => {
            const [file] = bannerImg.files;
            let label = document.getElementById("bannerLabel");
            let input = document.getElementById("bannerImg");
            var divPrev = document.getElementById("imgbannerPrev");
            if (file) {
                bannerPrev.src = URL.createObjectURL(file);
                imgPreview.src = URL.createObjectURL(file);
                divPrev.classList.add("my-3");
            }
        }
        // UPLOAD GAMBAR 1 2 3
        uploadPhoto1.onchange = evt => {
            const [file] = uploadPhoto1.files;
            let label = document.getElementById("labelPhoto1");
            let input = document.getElementById("uploadPhoto1");
            let wrap = document.getElementById("uploadImage1");
            if (file) {
                imagePreview1.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto2.onchange = evt => {
            const [file] = uploadPhoto2.files;
            let label = document.getElementById("labelPhoto2");
            let input = document.getElementById("uploadPhoto2");
            if (file) {
                imagePreview2.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto3.onchange = evt => {
            const [file] = uploadPhoto3.files;
            let label = document.getElementById("labelPhoto3");
            let input = document.getElementById("uploadPhoto3");
            if (file) {
                imagePreview3.src = URL.createObjectURL(file);
            }
        }
        // SET DAN GET DATA DARI INPUTAN
        function updateTitle(data) {
            let dateNow = new Date();
            let date = dateNow.getFullYear() + '-' + (dateNow.getMonth() + 1) + '-' + dateNow.getDate();
            document.getElementById("title_value").innerHTML = data;
            document.getElementById("created_date_value").innerHTML = date;
        }
        function updateKat(data) {
            document.getElementById("kategori_value").innerHTML = data;
        }
    </script>
@endsection
