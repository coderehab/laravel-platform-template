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
use App\Order;
use App\Taxonomy;

class OrderRestController extends Controller
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


  public function store(Request $request){
    $receivedOrder = $request->json('order');
    $order = new Order();
    $raw_products = $receivedOrder['products'];
    $products = [];
    foreach($raw_products as $product){
      $product['is_done'] = 0;
      array_push($products, $product);
    }

    $order->company_id = $receivedOrder['company_id'];
    if (isset($receivedOrder['user_id']))
      $order->user_id = $receivedOrder['user_id'];

    $order->username = $receivedOrder['details']['name'];
    $order->address = $receivedOrder['details']['address'];
    $order->postal = $receivedOrder['details']['postal'];
    $order->city = $receivedOrder['details']['city'];
    $order->phone = $receivedOrder['details']['phone'];
    $order->email = $receivedOrder['details']['email'];
    $order->notes = $receivedOrder['notes'];

    $order->productCount = $receivedOrder['product_count'];
    //$order->paymentMethod = $receivedOrder['payment_method'];
    $order->is_paid = 0;
    $order->is_printed = 0;
    $order->status = 'open';

    $order->subtotal = $receivedOrder['price_order'];
    $order->total = $receivedOrder['price_total'];

    $order->is_delivery = $receivedOrder['delivery'];
    $order->deliveryCosts = $receivedOrder['delivery_price'];
    $order->deliveryTime = $receivedOrder['order_ready'];

    $order->products = json_encode($products);
    $order->orderJson = json_encode($receivedOrder);
    $order->receipt =$this->createTextReceipt($receivedOrder);

    $order->save();

    return  Response::json(['success' => 'true']);

  }

  // get admin screens
  public function index()
  {
    $responsedata = new stdClass();
    $orders = Order::all();

    // get Order relationships
    $orders_array = [];
    foreach($orders as $Order){
      // products
      $Order->products = Order::find($Order->id)->products()->lists('id');
      // categories
      $Order->categories = Order::find($Order->id)->categories()->lists('id');
      $orders_array[] = $Order;
    }

    $responsedata->Order = $orders_array;

    // ALL categories
    $categories = Taxonomy::where('type','product_category')->whereIn('parent_id', $orders->lists('id'))->get();

    // get category products relationships
    $categories_array = [];
    foreach($categories as $category){
      $category->products = Product::where('taxonomy_id',$category->id)->lists('id');
      $categories_array[] = $category;
    }


    $responsedata->categories = $categories;

    // ALL products
    $products = Product::whereIn('Order_id', $orders->lists('id'))->get();
    $responsedata->products = $products;


    return Response::json($responsedata);
  }

  public function OrderCategories($Order_id){
    $categories = [];
  }


  private function createTextReceipt($receivedOrderJson){

    $details = $receivedOrderJson['details'];
    $products = $receivedOrderJson['products'];
    $ideal = $receivedOrderJson['ideal'];
    // $bank = $receivedOrderJson['bank'];
    $delivery = $receivedOrderJson['delivery'];
    $deliveryPrice = $receivedOrderJson['delivery_price'] ;
    $minPriceForDelivery = $receivedOrderJson['delivery_min_price'];
    $orderReady = $receivedOrderJson['order_ready'];

    $receipt = 'Nieuwe bestelling ('.date('Y-m-d H:i:s').')' . "\n\n";
    $receipt .= 'Bezorgen: ' . ($delivery ? 'ja' : 'nee') . "\n";
    if($delivery) $receipt .= 'Bestelling moet worden geleverd om: ' . $orderReady . "\n";
    else $receipt .= 'Bestelling wordt opgehaald op: ' . $orderReady . "\n";

    $receipt .= "\nKlantgegevens\n";
    $receipt .= "________________________________________\n\n";
    $receipt .= $details["name"] . "\n";
    $receipt .= $details["phone"] . "\n";
    $receipt .= $details["email"] . "\n\n";
    $receipt .= "Adres:" . "\n";
    $receipt .= $details["address"] . "\n";
    $receipt .= $details["postal"] . ' ' .  $details["city"] . "\n";
    $receipt .= "\nBestelling \n";
    $receipt .= "________________________________________\n\n";

    for ($i=0; $i < count($products); $i++) {
      $product = $products[$i];
      $receipt .= $product['amount'] . 'x - ' . $product['name'] . ' - € ' . $product['price'] . "\n";

      if ($product['description']) $receipt .= $product['description'] . "\n";

      $variations = $product['variations'];

      foreach( $variations as $variation ){

        if (isset($variation['value'])){

          if(count($variation['value']) > 0)
          {
            //var_dump($variation['value']);
            foreach($variation['value'] as $key => $value){
              //dd($value);
              if($key == "name")
                $receipt .= " -" . $value . "\n";
            }

          }

            else
              $receipt .= " -" . $variation['value']['name'] . "\n";
        }




      }

      if ($product['notes']) $receipt .= " -" . "Notitie: " . $product['notes'] . "\n";
      $receipt .= "\n";
    }

    $receipt .= "Totalen \n";
    $receipt .= "________________________________________\n\n";
    $receipt .= 'Bestelling totaal: €' . $receivedOrderJson["price_order"] . "\n";

    if($delivery) {
      if((float)$minPriceForDelivery <= (float)$receivedOrderJson["price_order"]) $deliveryPrice = '0.00';
      $receipt .= 'Bezorgkosten: €' . $deliveryPrice . "\n";
    }
    $receipt .= 'Totaal te betalen: €' . $receivedOrderJson["price_total"] . "\n";
    $receipt .= "\n\n";

    return $receipt;
  }
}
