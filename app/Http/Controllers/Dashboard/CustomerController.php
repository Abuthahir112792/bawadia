<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Mail;
use Session;
use Redirect;
use DB;
use Image;
class CustomerController extends Controller
{
    public function index()
    {
        $data=User::select('id','name','email','contact','type','image','address','lat','shipping_address_id','lon','status')
        ->where('type', 4)
        ->with('shipping')
        ->get();
        return $data;
    }
}