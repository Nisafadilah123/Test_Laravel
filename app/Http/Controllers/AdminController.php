<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        // memanggil data company
        $companies = Companies::all()->count();

        // memanggil data employee
        $employees = Employees::all()->count();

        // return view
        return view('Dashboard_admin', compact('companies', 'employees'));
    }

    public function dashboard_user(){
        // return view
        return view('Dashboard_user');

    }


}