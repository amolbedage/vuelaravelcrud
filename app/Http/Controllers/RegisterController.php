<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use App\contactus;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
       // dd($input);
        unset( $input['c_password']); 
        $user=User::create($input);
       // $user = DB::table('users')->insert($input);
           // dd($user);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;


        return $this->sendResponse($success, 'User register successfully.');
    }
}