<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Form;
use Redirect;
use App\Company;
use App\Allergen;

class CompanyController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $validations = [
		'name' => 'required',
	];

	public function __construct()
	{
		$this->middleware('auth');
	}

	// get admin screens
	public function index()
	{
		$view = view('company.index');
		$view->companies = Auth::user()->companies();

		return $view;
	}

	public function create()
	{
		$view = view('company.create');
		$view->company = new Company();
		return $view;
	}

	public function show($id)
	{
		$company = Company::find($id);
		$view = view('company.show');

		$view->company = Auth::user()->companies->first();
		$view->openinghours = json_decode(Auth::user()->companies->first()->openinghours, true);

			//dd($view->openinghours);

		return $view;
	}

	//crud functions
	public function store(Request $request)
	{
		$this->validate($request, $this->validations);

		$params = $request->all();
		$params['created_by'] = Auth::user()->id;
		$params['user_id'] = Auth::user()->id();

		$company = Company::create($params);
		return Redirect::route('admin.company.index');
	}

	public function update(Request $request, $id)
	{
		$company = Company::find($id);
		$params = $request->all();
		$this->validate($request, $this->validations);

		//dd($params);

		$params['pickup_available'] = isset($params['pickup_available']) ? $params['pickup_available'] : 0;
		$params['delivery_available'] = isset($params['delivery_available']) ? $params['delivery_available'] : 0;
		$params['payment_cash_available'] = isset($params['payment_cash_available']) ? $params['payment_cash_available'] : 0;
		$params['payment_account_available'] = isset($params['payment_account_available']) ? $params['payment_account_available'] : 0;
		$params['payment_ideal_available'] = isset($params['payment_ideal_available']) ? $params['payment_ideal_available'] : 0;

		$params['delivery_postal_areas'] = isset($params['delivery_postal_areas']) ? json_encode($params['delivery_postal_areas']) : "";
		$params['openinghours'] = isset($params['openinghours']) ? json_encode($params['openinghours']) : "";



		$company->update($params);
		return Redirect::back();
	}

	public function toggle_active($id){
		$company = Company::find($id);
		$company->active = $company->active ? 0 : 1;
		$company->save();
		return Redirect::back();
	}

	public function append_to_menu($id){
		$company = Company::find($id);
		$company->menu_id = 1;
		$company->save();
		return Redirect::back();
	}

	public function remove_from_menu($id){
		$company = Company::find($id);
		$company->menu_id = 0;
		$company->save();
		return Redirect::back();
	}

	public function destroy($id){
		$company = Company::find($id)->delete();
		return Redirect::route('admin.company.index');
	}

}
