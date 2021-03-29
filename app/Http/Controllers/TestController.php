<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirebaseToken;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Auth;
use App\User;
use Carbon\Carbon;
class TestController extends Controller
{
        public function __construct(Auth $auth)
        {
            $this->auth = $auth;
        }

    public function index(Request $request){ 
        $url = 'https://fcm.googleapis.com/fcm/send';
        $id=FirebaseToken::where('user_id',$request->id)->get();
        $id = $id->pluck('token');
        // return $id;
        // $id = $request->token;
//                'registration_ids' => array($id),

        $fields = array (
                
                'registration_ids' =>$id,
                'data' => array (
                        'id' => 160,
                        'title' => 'Zubaer Title',
                        "message" => 'Zubaer Message'
                        
                ),
                // 'notification' => array (
                //         'title' => "Test Noti",
                //         "body" => "Test Noti body", 
                //         "sound" => true, 
                //         "badge" => 1,
                // ),
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
        return $result;
    

   }
   public function show($token)
   {

        // $idTokenString = $token;

        // try {
        // $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        // } catch (\InvalidArgumentException $e) {
        // echo 'The token could not be parsed: '.$e->getMessage();
        // } catch (InvalidToken $e) {
        // echo 'The token is invalid: '.$e->getMessage();
        // }

        // $uid = $verifiedIdToken->getClaim('sub');
        // $user = $auth->getUser($uid);
        dd($this->auth->signInWithEmailAndPassword('zubaer.haque@gmail.com', 'asdasdasd'));
        return $this->auth->signInWithEmailAndPassword('zubaer.haque@gmail.com', 'asdasdasd');
   }
   public function edit($token)
   {

        $idTokenString = 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjdkNTU0ZjBjMTJjNjQ3MGZiMTg1MmY3OWRiZjY0ZjhjODQzYmIxZDciLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vcm9zZWhpbGwtbWFpbmFwIiwiYXVkIjoicm9zZWhpbGwtbWFpbmFwIiwiYXV0aF90aW1lIjoxNTkzMzM3NTU4LCJ1c2VyX2lkIjoiUkN3b3k3TFNScGFoRm9nUHJXTTNnMFEzYjlWMiIsInN1YiI6IlJDd295N0xTUnBhaEZvZ1ByV00zZzBRM2I5VjIiLCJpYXQiOjE1OTMzMzc1NTgsImV4cCI6MTU5MzM0MTE1OCwiZW1haWwiOiJ6dWJhZXIuaGFxdWVAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJmaXJlYmFzZSI6eyJpZGVudGl0aWVzIjp7ImVtYWlsIjpbInp1YmFlci5oYXF1ZUBnbWFpbC5jb20iXX0sInNpZ25faW5fcHJvdmlkZXIiOiJwYXNzd29yZCJ9fQ.UAx7iLUjTDOQFLc213dhUq2bIa-VLuGWs3ibKGPDYt16iA65-6by3AR4iUilk7M1CSKOiZWROafBbueSwdscNhPwxZuRjSuirEExfo38SkwRybEYty01uSxTcCYfb4XMRUJRP951IA3AWM2aSaSqhooCQyPcFBwHFT88fTXky4pbz-aa3XXkInviygMhYs_bpDgpChgC__dGhz0qhTL3fWh2K086iN5CLZxBZudgXFuo1WR8MHL_6FQ0LIi2sErWJU7K3BmUDxXupo3ONiF2GHs2PB1lWADJuNHS3v0p-MSXioZiJTUi1V83c6_aoC9b74487QjwOS97bZ5r7iGlIw';

        try {
        $verifiedIdToken = $this->auth->verifyIdToken($idTokenString);
        } catch (\InvalidArgumentException $e) {
        echo 'The token could not be parsed: '.$e->getMessage();
        } catch (InvalidToken $e) {
        echo 'The token is invalid: '.$e->getMessage();
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $user = $this->auth->getUser($uid);
        $user = User::where('email',$user->email)->first();
        // dd($user);
        // Here you could check if the user model exist and if not create it
        // For simplicity we will ignore this step

        // Once we got a valid user model
        // Create a Personnal Access Token
        $tokenResult = $user->createToken('Personal Access Token');
        
        // Store the created token
        $token = $tokenResult->token;
        
        // Add a expiration date to the token
        $token->expires_at = Carbon::now()->addYear(1);
        
        // Save the token to the user
        $token->save();
        
        // Return a JSON object containing the token datas
        // You may format this object to suit your needs
        return response()->json([
            'id' => $user->id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
            $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
   }
}

