<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\BaseTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use BaseTrait;
    public function tokenGenerate(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

        }
    }

    public function getUsers(){
        $users = User::get();
        return response()->json($users);
    }
}
