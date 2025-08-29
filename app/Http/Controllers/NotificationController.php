<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Session;
 
class NotifController extends Controller
{
	public function index(){
		return view('notifikasi');
	}
    
	public function success(){
		Session::flash('success','Ini notifikasi SUCCESS');
		return redirect('pesan');
	}

	public function warning(){
		Session::flash('warning','Ini notifikasi WARNING');
		return redirect('pesan');
	}

	public function failed(){
		Session::flash('failed','Ini notifikasi FAILED');
		return redirect('pesan');
	}
}