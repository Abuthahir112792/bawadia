<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Mail;
use Session;
use Redirect;
use DB;
use Image;
use App\ActivityLog;
use DateTime;
use App\FirebaseToken;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Auth as FireAuth;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct(FireAuth $auth)
    {
        $this->auth = $auth;
    }
   public function index(Request $request)
   {
       $data=User::select('id','name','email','contact','type','image','address','lat','lon','status','branch_id');
       if(isset($request->type) && !empty($request->type))
       {
            $data= $data->where('type',$request->type);
   
       }
       else{
        $data= $data->whereIn('type',[1,2]);

       }
       $data= $data->get();
       return $data;
   }
   public function profile()
   {
       $data=Auth::user();
       return $data;
   }

   
   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       
   }
   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'contact' => ['required', 'string','min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false
           ],200);
        }

        if( isset($request->name) && isset($request->password) && isset($request->email))
        {
            DB::beginTransaction();
            try {
                if(\Auth::check())
                {
                    $data=new User;
                    $data->name=$request->input('name');
                    $data->email=$request->input('email');
                    $data->contact=$request->input('contact');
                    $data->branch_id=$request->input('branch_id');
                    $data->address=$request->input('address');
                    $data->type=$request->input('type')?$request->input('type'):4;
                    $data->password=bcrypt($request->input('password'));
                    $data->save();               
                     
                }
                else
                {
                    $data=new User;
                    $data->name=$request->input('name');
                    $data->email=$request->input('email');
                    $data->contact=$request->input('contact');
                    $data->branch_id='';
                    $data->address=$request->input('address');
                    $data->password=bcrypt($request->input('password'));
                    $data->save();    
                }
                DB::commit();
                $status = true;  
            } catch (\Exception $e) {
                $data=$e->getMessage();
                $status = false;
                DB::rollback();
            }  
        }
        else 
        {
            return response()->json([
                'data' => 'Attributes are missing',
                'status' => false
           ],200);
        }
        return response()->json([
            'data' => $data,
            'status' => $status
        ],200);
   }
   public function avatar(Request $request)
   {
       $user_id = Auth::id();
       //return $request->all();
       $request->file('myFile')->store('public/uploads/avatar');
       $pic= '/storage/uploads/avatar/'.$request->myFile->hashName();   
       Image::make('storage/uploads/avatar/'.$request->myFile->hashName())->fit(600, 400, function($constraint) {
        $constraint->aspectRatio();})->save('storage/uploads/avatar/'.$request->myFile->hashName());              
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
            $update=User::where('id',$id)->update(
                [
                    'name' => $request->name,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'type' => $request->type,
                    'branch_id' => $request->branch_id,
                    'status' => $request->status

                ]);
            if($update)
            {
                return response()->json(
                    [
                        'status'=> true,
                        'message'=> 'Success'
                    ], 200);    
            }
        return response()->json(
            [
                'status'=> false,
                'message'=> 'Failed, Try Again'
            ], 200);    
    }
//    public function updateUser(Request $request)
//    {
//        $update=User::where('id',$request->id)->update(
//            [
//                'name' => $request->name
//            ]);
//        return $update;
//    }
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
            ->subject('Agent Password for Homeyfi');
        });
       return $update;
   }

   public function destroy($id)
   {
       $group = User::where('id','=',$id)
         ->first();
       $group->delete();
       return $group;
   }
   public function login(Request $request)
   {
    // $state = $request->session()->pull('state');

    // throw_unless(
    //     strlen($state) > 0 && $state === $request->state,
    //     InvalidArgumentException::class
    // );
    // dd($request->all());
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(config('app.url').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => config('app.passport'),
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json([
                    'message' => 'Invalid Request. Please enter a username or a password.',
                    'access_token' => false
                ], 200);
            } else if ($e->getCode() === 401) {
                return response()->json([
                    'message' => 'Your credentials are incorrect. Please try again',
                    'access_token' => false
                ],200);
            }
            return response()->json([
                'message' => $e->getMessage(),
                'access_token' => false
            ], 200);
        }
    }
    public function logout()
    {
        $clientIP = request()->ip();
        $user_id = Auth::id();
        // $now = new DateTime();
        // $max_id=ActivityLog::where('user_id', $user_id)->max('id');
        // ActivityLog::where('id', $max_id)->update([
        //     'updated_at'=> $now]);  // logout activity updated
       
        $userlog=new ActivityLog([      //to create user activity log..
            'admin_id' => $user_id,
            'user_id' => $user_id,
            'flag' => 'Log out',
            'ip' => $clientIP,
             ]);
        $userlog->save();
        if($userlog)
        {
            Auth::logout();
            Session::flush();
            return Redirect::to('/');
    
        }
        return false;
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
    public function getUserLog(Request $request)
    {
        $data=User::orderby('id', 'DESC')
        ->get();
        return $data;
    }
    public function passwordchange()
    {
        Auth::logout();
        return view('successful');
    }
    public function firebaseLogin(Request $request)
   {
        $idTokenString = $request->token;
        $email = $request->email;
        

        try {
        $verifiedIdToken = $this->auth->verifyIdToken($idTokenString);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'status' => false,
                'message' => 'The token could not be parsed: ',
                'error' => $e->getMessage(),
            ]
            );
        } catch (InvalidToken $e) {
            return response()->json([
                'status' => false,
                'message' => 'The token is invalid',
                'error' => $e->getMessage(),
            ]
            );
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $user = $this->auth->getUser($uid);
        if($request->email!=$user->email)
        {
            return response()->json([
                'status' => false,
                'message' => 'Wrong user email',
                'error' => 'Invalid Token',
            ]
            );
        }
        $user = User::firstOrCreate(
            [
                'email' => $email,
            ],
            [
                'name' => $request->displayName?$request->displayName:strstr($email, '@', true),
                'contact' => '974',
                'type' => 4,
                'password' => rand(10,100).substr($idTokenString, 1, 15),
            ]
        );
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYear(1);
        $token->save();
        
        // Return a JSON object containing the token datas
        // You may format this object to suit your needs
        return response()->json([
            'status' => true,
            'id' => $user->id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
            $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
   }
}