<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Offer;

class OfferController extends Controller
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
		$view = view('product.offer.index');
		$view->offers = Auth::user()->companies->first()->offers;
		return $view;
	}

	public function create()
	{
		$view = view('product.offer.create');
		$view->offer = new Offer();
		return $view;
	}

	public function show($id)
	{
		$offer = Offer::find($id);
		$view = view('product.offer.show');
		$view->offer = $offer;
		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['company_id'] = Auth::user()->companies->first()->id;

		Offer::create($params);
		return Redirect::route('admin.offer.index');
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->validations);
		$params = $request->all();

		Offer::find($id)->update($params);
		return Redirect::route('admin.offer.index');
	}

	public function destroy($id){
		$offer = Offer::find($id)->delete();
		return Redirect::route('admin.offer.index');
	}

}
