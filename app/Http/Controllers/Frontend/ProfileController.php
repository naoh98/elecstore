<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
       public function index() {
           $user = Auth::user();
           return view('frontend.contents.profile', compact('user'));
       }

       public function update(Request $request) {
            $user = Auth::user();

            $user->name = $request->name;
            $user->password = $request->password;
            $user->save();

            return redirect('/profile')->with('status', 'Your account has updated !');
       }

}
