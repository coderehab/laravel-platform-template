<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Hash;
use Validator;

class AccountController extends Controller{

    public function show(){

        $view = view('account.show');
        $view->user = Auth::user();
        return $view;
    }

    public function update(Request $request,$id)
    {
        /*
        Get all the parameters
        Check if the're set
        Check if the password has changed
        Update the user
        Redirect to the dashboard
        */
        $params = $request->all();

        $validator = Validator::make($request->all(),
            [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'email' => 'required|email|max:255',

                'password' => 'max:255',
                'confirm' => 'required_with:password|same:password'
            ]
        );

        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }


       // var_dump();
        //die;

        //dd($params);

        $params['firstname'] = isset($params['firstname']) ? $params['firstname'] : 0;
        $params['lastname'] = isset($params['lastname']) ? $params['lastname'] : 0;
        $params['email'] = isset($params['email']) ? $params['email'] : 0;
        if(empty($params['password'])){
            $params['password'] = Auth::user()->password;
        }

        Auth::user()->update($params);
        return Redirect::route('dashboard');

    }

}
