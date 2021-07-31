<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Sblogin;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    //
    public function adminList(){
        $list = DB::table('admins')->paginate(10);
        return view('backend.contents.admin.adminList',['list'=>$list]);
    }
    public function index() {
        $admin = DB::table('admins')->where('name', \session()->get('sblogin')['username'])->first();

        return view('backend.contents.admin.index', compact('admin'));
    }

    public function update(Request $request) {
        $adminname = \session()->get('sblogin')['username'];
        $admin = AdminModel::where('name', $adminname)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();

        return redirect('/admin/adminList')->with('status', 'Your account has updated !');
    }
}
