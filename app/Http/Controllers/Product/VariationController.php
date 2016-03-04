<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Variation;
use App\Product;

class VariationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $validations = [
		'name' => 'required',
		'description' => 'required',
		'type' => 'required',
	];

	public function __construct()
	{
		$this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$view = view('product.variation.index');
		$view->variations = Auth::user()->companies->first()->variations;
		return $view;
	}

	public function create()
	{
		$view = view('product.variation.create');
		$view->variation = new Variation();
		$view->product_list = Auth::user()->companies->first()->products->lists('name', 'id');
		return $view;
	}

	public function show($id)
	{
		$variation = Variation::find($id);
		$view = view('product.variation.show');
		$variation->linked_products = json_decode($variation->linked_products, true);

		$view->variation = $variation;
		$view->product_list = Auth::user()->companies->first()->products->lists('name', 'id');
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;

		$variation = Variation::create($params);
		return Redirect::route('admin.variation.show', $variation->id);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		$params['required'] = isset($params['required']) ? $params['required'] : 0;
		$params['linked_products'] = json_encode($params['products'],true);

		Variation::find($id)->update($params);
		return Redirect::route('admin.variation.index');
	}

	public function destroy($id){
		$variation = Variation::find($id)->delete();
		return Redirect::route('admin.variation.index');
	}

}
