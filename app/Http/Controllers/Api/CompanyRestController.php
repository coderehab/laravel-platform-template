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
use App\Company;
use App\Taxonomy;
use App\Variation;
use App\Allergen;

class CompanyRestController extends Controller
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
    $companies = Company::all();


    //

    // get company relationships
    $companies_array = [];
    foreach($companies as $company){


      // products
      $company->products = Company::find($company->id)
        ->products()
        ->where('menu_id', 1)
        ->where('active', 1)
        ->lists('id');

      $company->allergens = Allergen::all()->lists('id');

      // categories
      $company->categories = Company::find($company->id)
        ->categories()
        ->lists('id');

      $company->openinghours = json_decode( $company->openinghours,true);

      $companies_array[] = $company;
    }

    $responsedata->company = $companies_array;


    // all allergies
    $allergens = Allergen::all();
    $responsedata->allergens = $allergens;

    // ALL categories
    $categories = Taxonomy::where('type','product_category')
      ->whereIn('parent_id', $companies->lists('id'))
      ->get();

    // get category products relationships
    $categories_array = [];
    foreach($categories as $category){
      $category->products = Product::where('taxonomy_id',$category->id)
        ->where('menu_id', 1)
        ->where('active', 1)
        ->lists('id');

      $categories_array[] = $category;
    }

    $responsedata->categories = $categories;

    // all variations
    $variations_array = [];
    $variations = Variation::whereIn('company_id', $companies->lists('id'))->get();


    foreach($variations as $variation){
      $linked_products_array = [];
      $linked_products = json_decode($variation->linked_products,true);

      if(count($linked_products) > 0) {

        foreach($linked_products as $product){
          $newproduct = [];
          $newproduct['id'] = $product['id'];
          $newproduct['name'] = $product['name'];
          $newproduct['price'] = ($product['price'] != "") ? $product['price'] : Product::find($product['id'])->price;
          $newproduct['order'] = $product['order'];
          array_push($linked_products_array, $newproduct);
        }

        $variation->linked_products = $linked_products_array;
        array_push($variations_array, $variation);
      }
    }

    $responsedata->variations = $variations_array;

    // ALL products
    $products_array = [];
    $products = Product::whereIn('company_id', $companies->lists('id'))->where('menu_id', 1)->get();

    foreach($products as $product){
      $variations_array = [];
      $allergens_array = [];

      // variations
      foreach($product->variations as $variation){
        array_push($variations_array,$variation->id);
      }
      // allergies
      foreach($product->allergens as $allergy){
        array_push($allergens_array,$allergy->id);
      }

      unset($product->allergens);
      unset($product->variations);
      $product->allergens = $allergens_array;
      $product->variations = $variations_array;
      $products_array[] = $product;
    }

    //


    $responsedata->products = $products_array;
    return Response::json($responsedata);
  }

  public function companyCategories($company_id){
    $categories = [];
  }


  /*public function show($id)
  {
    $company = Company::find($id);
    $responsedata = new stdClass();
    $responsedata->company = Company::find($id);

    //categories
    $responsedata->company->categories = $company->categories()->lists('id');
    $responsedata->categories = $company->categories;

    //products
    $responsedata->company->products = $company->products()->lists('id');
    $responsedata->products = $company->products;

    return Response::json($responsedata);
  }*/

}
