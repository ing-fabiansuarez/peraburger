<?php namespace App\Controllers;

class Auth extends BaseController
{
	//--------------------------------------------------------------------
    public function login()
	{
		if(!session()->is_logged){
			return view('auth/login');
		}else{
			return redirect()->route('home_system');
		}
	}
}
