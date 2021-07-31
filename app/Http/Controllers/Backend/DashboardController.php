<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('sblogin')->except(['login', 'loginAdmin','register' , 'registerAdmin', 'logout']);
    }

    public function index(){
        return view('backend.contents.dashboard');

    }

    public function login() {
        return view('backend.sbadmin2.subviews.login');
    }

    public function register() {
        return view('backend.sbadmin2.subviews.register');
    }

    public function loginAdmin(Request $request) {

        $username = $request->input('username');
        $password = $request->input('password');


        $admin = DB::table('admins')->where('name', $username)->first();

        if ($admin && Hash::check($password, $admin->password)) {

            session(['sblogin' => [
                'username' => $username,
                'password' => $password
            ]]);
            return redirect('admin')->with('status', 'Login Success');
        }

        return redirect('admin/login')->with('status', 'Your username or password does not match. Please try again !');


    }

    public function registerAdmin(Request $request) {

        $rules = [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];

        $customMessages = [
            'required' => 'Trường :attribute required.',
        ];

        $this->validate($request, $rules, $customMessages);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = Hash::make($password);

        $admin = new AdminModel();
        $admin->name = $username;
        $admin->email = $email;
        $admin->password = $password;
        $admin->save();

        return redirect('admin/login')->with('status', 'Your account is ready.');

    }

    public function logout(Request $request) {

        $request->session()->forget('sblogin');

        return redirect('admin/login')->with('status', 'See you again.');

    }

}
