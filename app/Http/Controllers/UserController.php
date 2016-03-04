<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Company;
use App\Order;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{

		if(count(Auth::user()->companies) <= 0) {
			$company = new Company();
			$company->user_id = Auth::user()->id;
			$company->name = Auth::user()->firstname . " & co";
			$company->save();
		}

		$view = view('dashboard');
		$view->orders = Auth::user()->companies->first()->orders()->where('status', '!=', 'done')->get();
		$view->finished_orders = Auth::user()->companies->first()->orders()->where('status', 'done')->take(20)->orderby('id', 'DESC')->get();
		$view->selectedOrder = Order::find($request->get('order'));

		return $view;
	}
}
