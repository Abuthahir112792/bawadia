<?php

namespace App\Http\Controllers\API\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\Order;
use App\FirebaseToken;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=User::select('id','name','email','contact','type','image','address','lat','lon','status','branch_id')
            ->where('type',3)
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
        $validator = Validator::make($request->all(), [
            'delivery_agent' => ['required'],
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        $request->validate([
        ]);

        DB::beginTransaction();
        try {
            $response['data']=Order::where('id',$request->id)
            ->update(
                [
                    'delivery_agent' => $request->delivery_agent
                ]
            );
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
        $tokens=FirebaseToken::whereIn('user_id',$request->delivery_agent)->get();
        $plucked = $tokens->pluck('token');
        // dd($plucked->all());
        // $id = 'ejsK9G6x_DA:APA91bGJIjORT7Tm7IgvU6sY3xo0kkwmBZ3WomoS7JxsicuFMEn6eek0aJThnwlTE5UxYlrUOlcKWvO3jO1YQcw6EUvzAZ_LlVqr4THQN3sHDH2Nx21ZzBu39jf1ZuFlQonkbsRV8bOi';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array (
            // array($id),
                'registration_ids' => $plucked,

                'data' => array (
                        "title" => 'New order asigned',
                        "message" => 'Order #'.$request->id.' added to you'
                ),
                'notification' => array (
                    "title" => 'New order asigned',
                    "body" =>'Order #'.$request->id.' added to you',
                        "sound" => true, 
                        "badge" => 1,
                ),
                'time_to_live' => 600,
               
        );
        $fields = json_encode ( $fields );

        $serverKey= config('app.firebase_server_key');
        $headers = array (
                'Authorization: key=' .$serverKey,
                'Content-Type: application/json'
        );

        if($serverKey)
        {
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
            $result = curl_exec ( $ch );
           
            curl_close ( $ch );    
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
