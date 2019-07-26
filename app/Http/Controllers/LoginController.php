<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use URL;
use GuzzleHttp;
use GuzzleHttp\Client;
use Carbon\Carbon;


class LoginController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'email' => 'required|email',
            'password' => 'required'
          
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
           $arrInput         = $request->all();
          echo  $baseUrl        = URL::to('/'); 

           $arrOutputData=[];

        

         $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        //dd($user);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
  /*//create GuzzleHttp client
     $http = new GuzzleHttp\Client;
         

            //$response = $http->post('http://www.helpingcommunity.biz/helping-community/oauth/token', [
            $response = $http->post($baseUrl.'/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    //'client_id'     => Config::get('constants.server_client_id'),
                    //'client_secret' => Config::get('constants.server_client_secret'),
                    'client_id'   => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRETE'),
                    'email'      => $arrInput['email'],
                    'password'      => $arrInput['password'],
                    'scope'         => '',
                ],
            ]);

          //  $intCode    = Response::HTTP_OK;
           // $strMessage = "The user credentials matched";
           /// $strStatus  = Response::$statusTexts[$intCode];
            $passportResponse   = json_decode((string) $response->getBody());

            $client = new GuzzleHttp\Client;
            // check for user data
            // $userRequest = $client->request('GET', $baseUrl.'/api/user', [
            //     'headers' => [
            //         'Accept' => 'application/json',
            //         'Authorization' => 'Bearer '.$passportResponse->access_token,
            //     ],
            // ]);
            $user   = json_decode((string) $userRequest->getBody());
            $strTok = $passportResponse->access_token;
            $arrOutputData['access_token'] = $strTok;
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;

*/
        return $this->sendResponse($arrOutputData, 'Login successfully.');
    }

public function  chechauth(Request $request){


}

}