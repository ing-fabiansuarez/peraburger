<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('adminpage');
	}
	
	//--------------------------------------------------------------------
	public function page2()
	{
		return view('page2');
	}
}
