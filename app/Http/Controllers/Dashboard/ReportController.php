<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Image;
use App\Order;
use App\OrderProduct;
use Carbon\Carbon;
use App\Activitylog;
class ReportController extends Controller
{
    public function order(Request $request)
    {
        $response=array();
        $response['order']=Order::count();
        $response['ordertoday']=Order::whereDate('created_at', Carbon::today())->count();
        $response['orderpending']=Order::where('order_status', 4)->count();
        $response['delivered']=Order::where('order_status', 1)->count();
        $data=Order::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('created_at','>=',$start);
    
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('created_at','<=',$end);
    
        }  
        if(isset($request->store_id) && !empty($request->store_id))
        {
            $store_id=$request->store_id;
            $data=$data->where('store_id',$store_id);
    
        } 
        if(isset($request->order_status) && !empty($request->order_status))
        {
            $order_status=$request->order_status;
            $data=$data->where('order_status',$order_status);
    
        }  
        if(isset($request->customer_id) && !empty($request->customer_id))
        {
            $customer_id=$request->customer_id;
            $data=$data->where('user_id',$customer_id);
    
        }        
        $data=$data->with('product')
        ->with('order_status')
        ->with('branch')
        ->with('delivery');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
    
        }
        else
        {
            $data=$data->get();
        }
        $response['data'] =$data;
       return $response;
    }
    public function earning(Request $request)
    {
        $response=array();
        $response['earning']=Order::sum('total');
        $response['earningtoday']=Order::whereDate('created_at', Carbon::today())->sum('total');
        $response['earningpending']=Order::whereIn('order_status_id', [1,2,3])->sum('total');
        $response['delivered']=Order::whereIn('order_status_id', [4,5])->count();
        $data=Order::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('created_at','>=',$start);
    
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('created_at','<=',$end);
    
        }  
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
    
        } 
        if(isset($request->order_status_id) && !empty($request->order_status_id))
        {
            $order_status_id=$request->order_status_id;
            $data=$data->where('order_status_id',$order_status_id);
    
        }  
        if(isset($request->customer_id) && !empty($request->customer_id))
        {
            $customer_id=$request->customer_id;
            $data=$data->where('user_id',$customer_id);
    
        }        
        $data=$data->with('product')
        ->with('order_status')
        ->with('branch')
        ->with('delivery');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
    
        }
        else
        {
            $data=$data->get();
        }
        $response['data'] =$data;
       return $response;
    }

    public function commission(Request $request)
    {
        $response=array();
        $response['earning']=Order::sum('total');
        $response['earningtoday']=Order::whereDate('created_at', Carbon::today())->sum('total');
        $response['earningpending']=Order::where('order_status_id', 1)->sum('total');
        $response['delivered']=Order::where('order_status_id', 4)->count();
        $data=Order::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('created_at','>=',$start);
    
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('created_at','<=',$end);
    
        }  
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
    
        } 
        if(isset($request->order_status_id) && !empty($request->order_status_id))
        {
            $order_status_id=$request->order_status_id;
            $data=$data->where('order_status_id',$order_status_id);
    
        }  
        if(isset($request->customer_id) && !empty($request->customer_id))
        {
            $customer_id=$request->customer_id;
            $data=$data->where('user_id',$customer_id);
    
        }        
        $data=$data->with('product')
        ->with('order_status')
        ->with('branch')
        ->with('delivery');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
    
        }
        else
        {
            $data=$data->get();
        }
        $response['data'] =$data;
       return $response;

    }

    public function activitylog(Request $request)
    {
        $response=array();
        $data=Activitylog::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('created_at','>=',$start);
    
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('created_at','<=',$end);
    
        }
        if(isset($request->admin_id) && !empty($request->admin_id))
        {
            $admin_id=$request->admin_id;
            $data=$data->where('admin_id',$admin_id);
        } 
        if(isset($request->user_id) && !empty($request->user_id))
        {
            $user_id=$request->user_id;
            $data=$data->where('user_id',$user_id);
        } 
        $data=$data->with('admin')
        ->with('user');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
        }
        else
        {
            $data=$data->get();
        }
        $response['data'] =$data;
       return $response;
    }
}