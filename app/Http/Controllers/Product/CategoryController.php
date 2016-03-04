<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Taxonomy;

class CategoryController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $validations = [
		'name' => 'required',
		'description' => 'required',
	];

	public function __construct()
	{
		$this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$view = view('product.category.index');
		$view->categories = Auth::user()->companies->first()->categories;
		$view->category = new Taxonomy();
		return $view;
	}

	public function create()
	{
		$view = view('product.category.create');
		$view->category = new Taxonomy();
		return $view;
	}

	public function show($id)
	{
		$taxonomy = Taxonomy::find($id);
		$view = view('product.category.show');
		$view->category = $taxonomy;
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['parent_id'] = Auth::user()->companies->first()->id;
		$params['type'] = 'product_category';

		Taxonomy::create($params);
		return Redirect::route('admin.category.index');
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		Taxonomy::find($id)->update($params);
		return Redirect::route('admin.category.index');
	}

	public function destroy($id){
		$taxonomy = Taxonomy::find($id)->delete();
		return Redirect::route('admin.category.index');
	}

}
