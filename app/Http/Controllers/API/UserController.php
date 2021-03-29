<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\User;
use Auth;
use Mail;
use Session;
use Redirect;
use DB;
use Image;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
        $data=Auth::user();
        return $data;
   }
   public function getResetToken(Request $request)
   {
       $this->validate($request, ['email' => 'required|email']);
       $sent = $this->sendResetLinkEmail($request);

       return ($sent) 
           ? response()->json(['message'=>'Success'])
           : response()->json(['message'=>'Failed']);

   }
   public function create()
   {
       
   }
   public function store(Request $request)
   {
       
   }
   public function avatar(Request $request)
   {
       $user_id = Auth::id();
       //return $request->all();
       $request->file('avatar')->store('public/uploads/avatar');
       $pic= '/storage/uploads/avatar/'.$request->avatar->hashName();   
       Image::make('storage/uploads/avatar/'.$request->avatar->hashName())->fit(600, 400, function($constraint) {
        $constraint->aspectRatio();})->save('storage/uploads/avatar/'.$request->avatar->hashName());              
       $update=User::where('id', $user_id)->update([
           'image' => $pic
       ]);
       if($update)
       {
        return response()->json([
            'data' => $pic,
            'status' => true
        ],200);
        }
        return response()->json([
            'data' => 'Failed',
            'status' => false
        ],200);
   }
   public function show($id)
   {
       //
   }

   public function edit($id)
   {
       
   }

   public function update(Request $request, $id)
   {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        if(Auth::id()!=$id)
        {
            $response['data'] ='Auth id and Prams is didnt matched';
            return $response;

        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8'],
            'contact' => ['required', 'string','min:8'],
            'language' => ['required','string','min:2'],

        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
        }
        DB::beginTransaction();
        try {
        
            $response['data']=User::where('id',$id)->update(
                [
                    'name' => $request->name,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'lat' => $request->lat,
                    'lon' => $request->lon,
                    'language' => $request->language,
                    'shipping_address_id' => $request->shipping_address_id,

                ]);
        
            DB::commit();
            $response['status']=true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            DB::rollback();
        }
        return response()->json($response);

    }
    public function location(Request $request)
    {
         $response=array();
         $response['status']=false;
         $response['data'] ='';
         $id=Auth::id();
         DB::beginTransaction();
         try {
         
             $response['data']=User::where('id',$id)->update(
                 [
                     'lat' => $request->lat,
                     'lon' => $request->lon, 
                 ]);
         
             DB::commit();
             $response['status']=true;
         } catch (\Exception $e) {
             $response['data']=$e->getMessage();
             DB::rollback();
         }
         return response()->json($response);
 
     }

   public function updatepassword(Request $request)
   {
        $update=User::where('id',$request->id)->update(
           [
               'password'=>bcrypt($request->password),
               'status' => 2
           ]
        );
        $data['password'] =$request->password;
        $data['email'] =$request->email;
        Mail::send('mailview', $data, function($message) use ($request) {
            $message->to( $request->email , $request->name )
            ->subject('Agent Password for Site');
        });
       return $update;
   }

   public function destroy($id)
   {

   }
    public function logout()
    {

        $response=array();
        $response['status']=false;
        $response['data']='';
        try {
            $user = Auth::user()->token();
            $response['data']=$user->revoke();
            $response['status']=true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            DB::rollback();
        }
        return response()->json($response);
    }
    public function changePass(Request $request)
    {
        $request->validate([
            'newPassword' => ['required'],
            'confirmPassword' => ['same:newPassword'],
        ]);
        if(!Hash::check($request->oldPassword,Auth::user()->password))
        {
            return response()->json(
                [
                    'status'=> false,
                    'message'=> 'Current Password dose not matched'
                ], 200);
        }
        else
        {                     
            $update=User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);  
            if($update)   
            {
                return response()->json(
                    [
                        'status'=> true,
                        'message'=> 'Successfuly Changed'
                    ], 200);
            } 
            else
            {
                return response()->json(
                    [
                        'status'=> false,
                        'message'=> 'Failed, Try again'
                    ], 200);
            }

        }
    }
}