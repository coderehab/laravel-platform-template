<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Order;

class OrderController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $validations = [

	];

	public function __construct()
	{
		$this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$view = view('order.index');
		$view->orders = Auth::user()->companies->first()->orders;
		return $view;
	}

	public function create()
	{
		$view = view('order.create');
		$view->order = new Order();
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		return $view;
	}

	public function show($id)
	{
		$order = Order::find($id);
		$view = view('order.show');
		$view->order = $order;
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;

		Order::create($params);
		return Redirect::route('admin.order.index');
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		Order::find($id)->update($params);
		return Redirect::route('admin.order.index');
	}

	public function complete(Request $request, $id){
		$order = Order::find($id);
		$order->status = 'done';
		$order->save();
		return Redirect::route('dashboard');
	}

	public function destroy($id){
		$order = Order::find($id)->delete();
		return Redirect::route('admin.order.index');
	}

}
