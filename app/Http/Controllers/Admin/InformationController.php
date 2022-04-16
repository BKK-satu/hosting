<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Informasi;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    protected $informasiModel;
    protected $adminModel;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->adminModel = new Admin;
        $this->informasiModel = new Informasi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $data_informasi = Informasi::where('title', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            // $data_informasi = Alumni::orderBy('nis', 'ASC')->get();
            $data_informasi = Informasi::orderBy('title', 'ASC')->orderBy('created_at', 'DESC')->get();
        }

        // dd($news);
        $data = [
            'active' => 'informations',
            'data_informasi' => $data_informasi
        ];

        return view('admin.informations.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'admin' => $this->adminModel->first(),
            'active' => 'informations'
        ];

        return view('admin.informations.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // buat otomatis slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        $id_informasi = DB::select('SELECT newidinformasi() AS id_informasi');
        $id_informasi = $id_informasi[0];
        $id_informasi = $id_informasi->id_informasi;

        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img/news'), $fullFileBanner);
        }else{
            $fullFileBanner = 'default-informasi.jpeg';
        }

        // SAVING BANNER
        $photo1 = $request->file('photo1');
        // JIKA BANNER ADA
        if ($photo1 !== null) {
            // BUAT NAMA BARU
            $namePhoto1 = pathinfo($photo1->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto1 = $namePhoto1 . "-" . time() . Str::random(5) . "." .$photo1->getClientOriginalExtension();
            // PINDAHIN
            $photo1->move(public_path('/assets/img/news'), $fullFilePhoto1);
        }else{
            $fullFilePhoto1 = 'default-company.png';
        }

        // SAVING BANNER
        $photo2 = $request->file('photo2');
        // JIKA BANNER ADA
        if ($photo2 !== null) {
            // BUAT NAMA BARU
            $namePhoto2 = pathinfo($photo2->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto2 = $namePhoto1 . "-" . time() . Str::random(5) . "." .$photo2->getClientOriginalExtension();
            // PINDAHIN
            $photo2->move(public_path('/assets/img/news'), $fullFilePhoto2);
        }else{
            $fullFilePhoto2 = 'default-company.png';
        }

        // SAVING BANNER
        $photo3 = $request->file('photo3');
        // JIKA BANNER ADA
        if ($photo3 !== null) {
            // BUAT NAMA BARU
            $namePhoto3 = pathinfo($photo3->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto3 = $namePhoto3 . "-" . time() . Str::random(5) . "." .$photo3->getClientOriginalExtension();
            // PINDAHIN
            $photo3->move(public_path('/assets/img/news'), $fullFilePhoto3);
        }else{
            $fullFilePhoto3 = 'default-company.png';
        }
        // dd($banner);
        $data_informasi = Informasi::create([
            'id_informasi' => $id_informasi,
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'slug' => $slug,
            'banner' => $fullFileBanner,
            'image_satu' => $fullFilePhoto1,
            'image_dua' => $fullFilePhoto2,
            'image_tiga' => $fullFilePhoto3,
            'content' => $request->content,
        ]);

        return redirect('/ad/nw/main')->with('msg', 'Informasi Terbaru Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = $this->informasiModel->where('slug', $id)->first();

        $data = [
            'active' => 'informations',
            'new' => $new,
        ];
        return view('admin.informations.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = $this->informasiModel->where('slug', $id)->first();

        // dd($new);
        $data = [
            'active' => 'informations',
            'admin' => $this->adminModel->first(),
            'new' => $new,
        ];


        return view('admin.informations.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'title' => 'required',
            // 'banner' => 'required',
            // 'photo1' => 'required',
            // 'photo2' => 'required',
            // 'photo3' => 'required',
            'content' => 'required',
            ]);

            // buat otomatis slug
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));


        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img/news'), $fullFileBanner);
        } else {
            $fullFileBanner = 'default-informasi.jpeg';
        }

        // SAVING BANNER
        $photo1 = $request->file('photo1');
        // JIKA BANNER ADA
        if ($photo1 !== null) {
            // BUAT NAMA BARU
            $namePhoto1 = pathinfo($photo1->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto1 = $namePhoto1 . "-" . time() . Str::random(5) . "." .$photo1->getClientOriginalExtension();
            // PINDAHIN
            $photo1->move(public_path('/assets/img/news'), $fullFilePhoto1);
        } else {
            $fullFilePhoto1 = 'default-company.png';
        }

        // SAVING BANNER
        $photo2 = $request->file('photo2');
        // JIKA BANNER ADA
        if ($photo2 !== null) {
            // BUAT NAMA BARU
            $namePhoto2 = pathinfo($photo2->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto2 = $namePhoto1 . "-" . time() . Str::random(5) . "." .$photo2->getClientOriginalExtension();
            // PINDAHIN
            $photo2->move(public_path('/assets/img/news'), $fullFilePhoto2);
        } else {
            $fullFilePhoto2 = 'default-company.png';
        }

        // SAVING BANNER
        $photo3 = $request->file('photo3');
        // JIKA BANNER ADA
        if ($photo3 !== null) {
            // BUAT NAMA BARU
            $namePhoto3 = pathinfo($photo3->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFilePhoto3 = $namePhoto3 . "-" . time() . Str::random(5) . "." .$photo3->getClientOriginalExtension();
            // PINDAHIN
            $photo3->move(public_path('/assets/img/news'), $fullFilePhoto3);
        } else {
            $fullFilePhoto3 = 'default-company.png';
        }

        $data_informasi = Informasi::findOrFail($id);
        // dd($banner);

        // dd($id, $request->all(), $fullFileBanner, $fullFilePhoto1, $fullFilePhoto2, $fullFilePhoto3, $slug);
        $data_informasi->update([
            'id_informasi' => $id,
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'banner' => $fullFileBanner,
            'image_satu' => $fullFilePhoto1,
            'image_dua' => $fullFilePhoto2,
            'image_tiga' => $fullFilePhoto3,
            'content' => $request->content,
        ]);

        return redirect('/ad/nw/detail/' . $slug)->with('msg', 'Informasi Terbaru Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->informasiModel->findOrFail($id);

    }
}