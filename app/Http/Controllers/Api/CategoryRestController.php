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
use App\Taxonomy;

class CategoryRestController extends Controller
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
    $categories = Taxonomy::where('type','product_category')->get();
    //$responsedata->products = Auth::user()->companies->first()->products;
    $responsedata->categories = $categories;

   /* $products = Product::whereIn('company_id', $company->lists('id'))->get();

    $responsedata->products = $products;*/

    return Response::json($responsedata);
  }


  public function show($id)
  {
    $company = Company::find($id);
    $responsedata = new stdClass();
    //$responsedata->products = Auth::user()->companies->first()->products;
    $responsedata->company = Company::find($id);
    $responsedata->company->products = $company->products()->lists('id');

    $responsedata->products = $company->products;

    return Response::json($responsedata);
  }

}
