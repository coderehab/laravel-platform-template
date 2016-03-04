<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Allergen;

class AllergenController extends Controller
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
		$view = view('product.allergen.index');
		$view->allergens = Allergen::all();
		return $view;
	}

	public function create()
	{
		$view = view('product.allergen.create');
		$view->allergen = new Allergen();
		return $view;
	}

	public function show($id)
	{
		$allergen = Allergen::find($id);
		$view = view('product.allergen.show');
		$view->allergen = $allergen;
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;

		Allergen::create($params);
		return Redirect::route('admin.allergen.index');
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		Allergen::find($id)->update($params);
		return Redirect::route('admin.allergen.index');
	}

	public function destroy($id){
		$allergen = Allergen::find($id)->delete();
		return Redirect::route('admin.allergen.index');
	}

}
