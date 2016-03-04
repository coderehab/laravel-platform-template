<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Product;
use App\Allergen;

class ProductController extends Controller
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
		$this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$view = view('product.index');
		$view->menu_products = Auth::user()->companies->first()->products()->where('menu_id', 1)->get();
		$view->other_products = Auth::user()->companies->first()->products()->where('menu_id', 0)->get();
		$view->categories = Auth::user()->companies->first()->categories;

		return $view;
	}

	public function create()
	{
		$view = view('product.create');
		$view->product = new Product();
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		$view->variations_list = Auth::user()->companies->first()->variations()->lists('name', 'id');
		$view->allergens_list = Allergen::all()->lists('name', 'id');

		return $view;
	}

	public function show($id)
	{
		$product = Product::find($id);
		$view = view('product.show');

		$view->product = $product;
		$view->category_list = Auth::user()->companies->first()->categories()->lists('name', 'id');
		$view->variations_list = Auth::user()->companies->first()->variations()->lists('name', 'id');
		$view->offers_list = Auth::user()->companies->first()->offers()->lists('name', 'id');
		$view->allergens_list = Allergen::all()->lists('name', 'id');;

		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;
		$params['created_by'] = Auth::user()->id;
		$params['menu_id'] = 0;

		$product = Product::create($params);

		if(gettype($params['variations']) != 'array') $params['variations'] = [];
		$product->variations()->sync($params['variations']);

		if(gettype($params['allergens']) != 'array') $params['allergens'] = [];
		$product->allergens()->sync($params['allergens']);

		return Redirect::route('admin.product.index');
	}

	public function update(Request $request, $id)
	{
		$product = Product::find($id);
		$params = $request->all();

		$this->validate($request, $this->validations);

		if(gettype($params['variations']) != 'array') $params['variations'] = [];
		$product->variations()->sync($params['variations']);

		if(gettype($params['allergens']) != 'array') $params['allergens'] = [];
		$product->allergens()->sync($params['allergens']);

		if(gettype($params['offers']) != 'array') $params['offers'] = [];
		$product->offers()->sync($params['offers']);

		$product->update($params);
		return Redirect::route('admin.product.index');
	}

	public function toggle_active($id){
		$product = Product::find($id);
		$product->active = $product->active ? 0 : 1;
		$product->save();
		return Redirect::back();
	}

	public function append_to_menu($id){
		$product = Product::find($id);
		$product->menu_id = 1;
		$product->save();
		return Redirect::back();
	}

	public function remove_from_menu($id){
		$product = Product::find($id);
		$product->menu_id = 0;
		$product->save();
		return Redirect::back();
	}

	public function destroy($id){
		$product = Product::find($id)->delete();
		return Redirect::route('admin.product.index');
	}

}
