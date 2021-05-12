<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('admin/structure/main_admin_view');
	}
	
	//--------------------------------------------------------------------
	public function page2()
	{
		return view('page2');
	}
}
