<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TableBooking;
use Auth;
use DB;
use Carbon\Carbon;
class TableBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=TableBooking::orderBy('id','DESC')
        ->with('branch')
        ->get();
       return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        
        DB::beginTransaction();
        try {
            $data=TableBooking::create([
                'admin_id' => $auth_id,
                'branch_id' => $request->branch_id,
                'name' => $request->name,
                'phone_no' => $request->phone_no,
                'no_of_person' => $request->no_of_person,
                'time' => $request->time,
                'date' => $request->date,
                'status' => $request->status,
            ]);
            $response['data']=TableBooking::with('branch')
            ->find($data->id);
           
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
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
    public function edit($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            $data=TableBooking::where('id',$id)
            ->update([
                'status' => $request->status=="true"?1:0,
            ]);         
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
            TableBooking::where('id',$id)
            ->update([
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'phone_no' => $request->phone_no,
                'no_of_person' => $request->no_of_person,
                'time' => $request->time,
                'date' => $request->date,
                'status' => $request->status,
            ]);
            $response['data']= TableBooking::with('branch')
            ->find($id);
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = TableBooking::find($id);
        if($response['data'])
        {
            
            TableBooking::where('id',$id)->delete();
            $response['data']=$response['data']->delete();
             
        }
        else
        {
            $response['data']="Category not Exist";  
        }
        return response()->json($response);
    }

    public function tablebooking(Request $request)
    {
        $response=array();
        $data=TableBooking::orderBy('id','DESC');
        if(isset($request->start) && !empty($request->start))
        {
            $start= new Carbon($request->start);
            $start=$start->startOfDay();
            $data=$data->where('date','>=',$start);
        } 
        if(isset($request->end) && !empty($request->end))
        {
            $end= new Carbon($request->end);
            $end=$end->endOfDay();
            $data=$data->where('date','<=',$end);
    
        }
        if(isset($request->branch_id) && !empty($request->branch_id))
        {
            $branch_id=$request->branch_id;
            $data=$data->where('branch_id',$branch_id);
        } 
        $data=$data->with('branch');
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
