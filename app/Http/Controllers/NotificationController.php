<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Session;
 
class NotificationController extends Controller
{
	public function index(){
		return view('notifications.index');
	}
    
	public function success(){
		Session::flash('success','Ini notifikasi SUCCESS');
		return redirect('notifications');
	}

	public function warning(){
		Session::flash('warning','Ini notifikasi WARNING');
		return redirect('notifications');
	}

	public function failed(){
		Session::flash('failed','Ini notifikasi FAILED');
		return redirect('notifications');
	}
}