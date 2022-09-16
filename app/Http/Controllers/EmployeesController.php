<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // halaman index data employees
        // memanggil data employees
        $emps = Employees::all();
        // memanggil data company
        $company = Companies::all();

        // return view
        return view('CRUD_emp.index', compact('emps', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //halaman tambah data

        // memanggil data employees
        $emp = Employees::all();
        // memanggil data companies
        $comp = Companies::all();

        // return view
        return view('CRUD_emp.create', compact('emp', 'comp'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'id_companies' => 'required',
            'email' => 'required',
            'phone' => 'required|min:12',
        ], [
            'first_name.required' => 'Full of First Name',
            'last_name.required' => 'Full of Last Name',
            'id_companies.required' => 'Choose of Companies',
            'email.required' => 'Full of Email Employees',
            'phone.required' => 'Full of Phone Employees',

        ]);

        // pengkondisian email tidak boleh sama
        $insert=DB::table('employees')->where('email', $request->email)->first();
        if ($insert != null) {
            Alert::error('Gagal', 'Data Tidak Berhasil Di Tambah. Email Sudah Ada ');

            return redirect('/employees');
        }
        else {
        //proses tambah data
            $emp = new Employees;
            $emp->first_name = $request->first_name;
            $emp->last_name = $request->last_name;
            $emp->id_companies = $request->id_companies;
            $emp->email = $request->email;
            $emp->phone = $request->phone;
            // simpan data
            $emp->save();
            Alert::success('Berhasil', 'Data berhasil di tambahkan');

            return redirect('/employees');
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
    public function edit(Employees $employee)
    {
        //halaman edit employees
        // memanggil data companies
        $comp = Companies::all();

        // return view
        return view('CRUD_emp.edit', compact('employee', 'comp'));

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
         // validasi data
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'id_companies' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:12',
        ], [
            'first_name.required' => 'Full of First Name',
            'last_name.required' => 'Full of Last Name',
            'id_companies.required' => 'Choose of Companies',
            'email.required' => 'Full of Email Employees',
            'phone.required' => 'Full of Phone Employees',
        ]);

        //proses edit data
        Employees::whereId($id)->update($data);
            Alert::success('Berhasil', 'Data berhasil di ubah');

            return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employee)
    {
        // hapus data
        $employee->delete();
        Alert::success('Berhasil', 'Data berhasil di Hapus');

        return redirect('/employees');
    }
}