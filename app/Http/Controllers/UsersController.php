<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

	// Controls user logins.

    public function login()
    {
    	$tokenName = 'trello-clone';

    	// Get the items from the request.

    	$login = [
    		'email'	=> request('email'),
    		'password'	=>	request('password')
    	];

    	// Attempt the login.

    	if(Auth::attempt($login)) 
    	{
    		// Creates the auth token for the user.
    		$success['token'] = Auth::user()->createToken($tokenName)->accessToken;
    		
    		// Return the successful response.
    		return response()->json(['success' => $success], 200);

    	} 
    	else {
    		return response()->json(['error' => 'You are not allowed here.'], 401);
    	}
    }

    // function for logging out.
    public function logout() 
    {
    	if (Auth::check()) {
            Auth::user()->AauthAccessToken()->delete();
            return response()->json(
                    array(
                        'status' => 200,
                        'message' => "User logged out.",
                        'reason' => "User logged out successfully.",
                ), 200
            );
        }
    }

    // Registration function for registering the user.

    public function register(Request $request) 
    {
    	$tokenName = 'trello-clone';

    	// Validate the request and make sure everything was sent in correctly.
    	$validator = Validator::make($request->all(), User::$rules);

    	if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // else, just go ahead and create a new user. 
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $success['token'] = $user->createToken($tokenName)->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success], 200);
    } 

    // Mostly for testing, returns the status of the currently logged in user.
    public function getDetails()
    {
        return response()->json(['success' => Auth::user()], 200);
    }
}
