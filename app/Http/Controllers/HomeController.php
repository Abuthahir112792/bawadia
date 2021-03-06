<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        $user=Auth::user();
        if($user->type==1 || $user->type==2)
        {
            return view('dashboard');
        }
        else
        {
            return view('restriction');
        }
    }

}
