<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class DashboardController extends Controller
{
    public function index()
    {
        $response=array();
        $response['order']=Order::where('status', 1)->count();
        $response['ordertoday']=Order::whereDate('created_at', Carbon::today())->count();
        $response['orderpending']=Order::where('order_status_id', 1)->count();
        $response['product']=Product::where('status', 1)->count();
        $response['producttoday']=Product::whereDate('created_at', Carbon::today())->count();
        $response['customer']=User::where('type', 4)->count();
        $response['customertoday']=User::whereDate('created_at', Carbon::today())->count();
        $response['saleweek']=DB::table("orders")
	    ->select(DB::raw("SUM(total) as count"))
	    ->orderBy("created_at")
        ->groupBy(DB::raw("day(created_at)"))
        ->whereBetween('created_at', [Carbon::now()->subDays(7),Carbon::now()])
        ->get();
        $response['orderweek']=DB::table("orders")
	    ->select(DB::raw("COUNT(id) as count"))
	    ->orderBy("created_at")
        ->groupBy(DB::raw("day(created_at)"))
        ->whereBetween('created_at', [Carbon::now()->subDays(7),Carbon::now()])
        ->get();
        $response['customerlist']=User::where('type', 4)->orderBy('id','DESC')->limit(20)->get();
        $response['orderpendinglist']=Order::where('order_status_id', 1)->orderBy('id','DESC')->get();
        return $response;
    }
}
