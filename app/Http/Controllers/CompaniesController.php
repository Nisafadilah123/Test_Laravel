<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // halaman index data companies
        // memanggil data company
        $comps = Companies::all();

        // retur view
        return view('CRUD_comp.index', compact('comps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //halaman tambah data
        $comp = Companies::all();

        // return view
        return view('CRUD_comp.create', compact('comp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required',
            'website' => 'required',
        ], [
            'name.required' => 'Full of Name Company',
            'email' => 'Full of Email Company',
            'logo.required' => 'Pilih Logo Company',
            'website.required' => 'Full of Website Company',
        ]);

        // pengkondisian email tidak boleh sama
        $insert=DB::table('companies')->where('email', $request->email)->first();
        if ($insert != null) {
            Alert::error('Gagal', 'Data Tidak Berhasil Di Tambah. Email Sudah Ada ');

            return redirect('/companies');
        }else{
            // proses penyimpanan untuk tambah companies
            $input = $request->all();
            // simpan logo
            if ($image = $request->file('logo')) {
                $destinationPath = 'logo/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['logo'] = "$profileImage";
            }

            // simpan data
            Companies::create($input);
            // notif alert
            Alert::success('Berhasil', 'Data berhasil di tambahkan');

            return redirect('/companies');

            }

        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $company)
    {
        //halaman edit companies
        return view('CRUD_comp.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $company)
    {
        // validasi data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'website' => 'required',
        ], [
            'name.required' => 'Full of Name Company',
            'email' => 'Full of Email Company',
            'website.required' => 'Full of Website Company',
        ]);

        //update company
        $company->name = $request->name;
        $company->email =$request->email;
        $company->website = $request->website;


        if ($image = $request->file('logo')) {
            $destinationPath = 'logo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);

            $company->logo = $profileImage;
        }else{
            unset($company['logo']);
        }
        $company->save($data);
        Alert::success('Berhasil', 'Data berhasil di ubah');

        return redirect('/companies');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        // hapus data company
        $company->delete();
        Alert::success('Berhasil', 'Data berhasil di Hapus');

        return redirect('/companies');

    }
}