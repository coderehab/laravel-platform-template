<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Response;
use stdClass;
use Redirect;
use App\Product;

class ProductRestController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $validations = [
		'name' => 'required',
		'description' => 'required',
		'price' => 'required',
	];

	public function __construct()
	{
		// $this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$responsedata = new stdClass();
		$responsedata->product = Product::all();

		return Response::json($responsedata);
	}

	public function create()
	{
		$view = view('product.create');
		$view->product = new Product();
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		return $view;
	}

	public function show($id)
	{
		$product = Product::find($id);
		$view = view('product.show');
		$view->product = $product;
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;

		Product::create($params);
		return Redirect::route('admin.product.index');
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		Product::find($id)->update($params);
		return Redirect::route('admin.product.index');
	}

	public function destroy($id){
		$product = Product::find($id)->delete();
		return Redirect::route('admin.product.index');
	}

}
