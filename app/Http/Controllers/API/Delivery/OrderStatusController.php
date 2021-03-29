<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Order;
use App\OrderHistory;
use Auth;
use App\User;
use App\FirebaseToken;

class OrderStatusController extends Controller
{
    public function update(Request $request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $auth_id=Auth::id();
        DB::beginTransaction();
        try {
            $response['data']=Order::where('id',$id)
            ->update([
                'order_status_id' => $request->order_status_id,
            ]);
            $create=OrderHistory::create(
                [
                    'user_id' => $auth_id,
                    'order_id' => $id,
                    'order_status_id' => $request->order_status_id,
                    'comment' => $request->comment,
                ]
            );       
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage().', Line: '.$e->getLine();
            $response['status'] = false;
            DB::rollback();
        }
        if($request->order_status_id==3 || $request->order_status_id==4 )
        {
            $title='Order #'.$id.'';
            $description="Order status has Change";
            if($request->order_status_id==3)
            {                
                $title='Order #'.$id.' is on way';
                $description="Our rider is on the way to your place with your delivery";
            }
            else if($request->order_status_id==4)
            {                
                $title='Order #'.$id.' delivered';
                $description="Successfully completed delivery";
            }
            $order=Order::find($id);
            $admin=User::where('type',1)->get();
            $adminpluck = $admin->pluck('id');
            $data=FirebaseToken::where('user_id',$order->user_id)->get();
            $plucked = $data->pluck('token');
            // dd($plucked->all());
            // $id = 'ejsK9G6x_DA:APA91bGJIjORT7Tm7IgvU6sY3xo0kkwmBZ3WomoS7JxsicuFMEn6eek0aJThnwlTE5UxYlrUOlcKWvO3jO1YQcw6EUvzAZ_LlVqr4THQN3sHDH2Nx21ZzBu39jf1ZuFlQonkbsRV8bOi';
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array (
                // array($id),
                    'registration_ids' => $plucked,

                    'data' => array (
                            'title' => $title,
                            "message" => $description
                    ),
                    'notification' => array (
                            'title' => $title,
                            "body" => $description,
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

        }
        
            
        return response()->json($response);
    }

}
