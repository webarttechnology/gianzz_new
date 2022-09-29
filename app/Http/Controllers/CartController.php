<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Product;
use Jackiedo\Cart\Facades\Cart;
use App\Models\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;
use DB;

class CartController extends Controller
{
    public function cart(Request $request){
        if($request->method() == 'GET'){
            return view('cart');
        }
    }

    public function addItem(Request $request ,array $attributes = [], $withEvent = true){
        $shoppingCart   = Cart::name('shopping');
        $addtocartdetails = $request->get('item');

        // print_r($addtocartdetails);die;

        $productItem  = $shoppingCart->addItem([
            'id'       => $addtocartdetails['id'],
            'title'    => $addtocartdetails['title'],
            'quantity' => $addtocartdetails['quantatity'],
            'price'    => $addtocartdetails['price'],   // Final price with discount
            'options' => [
                'size' => [   // Size for Rope chain option
                    'label' => $addtocartdetails['size'],
                    'value' => $addtocartdetails['size']
                ],
                'color' => [   // Gold Color
                    'label' => $addtocartdetails['color'],
                    'value' => $addtocartdetails['color'],
                ]
            ],
            'extra_info' => [
                'date_time' => [
                    'added_at' => time(),
                ],
                'image' =>[
                    'img' =>$addtocartdetails['img'],
                ],
                'amount' =>[
                    'amount' =>$addtocartdetails['amount'],   // Product amount
                ],
                'sku_code' =>[
                    'sku_code' =>$addtocartdetails['sku_code']
                ],               
                'carat' =>[
                    'carat' =>$addtocartdetails['carat']
                ]
            ]

           
        ]);
        
        $hashCode  = $productItem->get('hash');
        $title     = $productItem->get('title');
        $quantity  = $productItem->get('quantity');
        $extraInfo = $productItem->get('extra_info');     
        $items = Cart::name('shopping')->getItems();
       echo count($items);
    }
   
    public function getaddtocartdata($attribute, $default = null){
        $items = Cart::name('shopping')->getItems();
        $newarray =[];
        foreach ($items as  $item) {
            $newarray[] =[
                'id' =>$item->getId(),
                'price' =>$item->getPrice(),
                'title' =>$item->getTitle(),
                'quantatity' =>$item->getQuantity(),
                'option' =>$item->getOptions(),
                'extra_info' =>$item->getExtra_info(),
                'hash' =>$item->getHash(),
             ];
          
        }     
       // print_r($newarray[0]['extra_info']['image']['img']);die;
        return view('cart',['addtocart' =>$newarray,'totalitem'=>count($newarray)]);
    }


    public function removeItem(Request $request,$id =''){
        if($request -> method() =='GET') { 
            Cart::name('shopping')->removeItem($id);
            return Redirect::to('/add-to-cart');
        }
       
    }


    public function getOrdersummery(){

        $items = Cart::name('shopping');   

        $totalSave = 0;
        $getItems = $items -> getItems();

        $discount = array();
        $today=date("Y-m-d");
        $discount =DB::table('discounts')->where('start_date','<=',$today)
                  ->where('end_date','>=',$today)->get();
        $discountPrice = 0;
        foreach ($discount as $sum){
            $discountPrice+=$sum->amount;
        }
        
        //echo $discountPrice;die;
       
        foreach($getItems as $key => $val){ 
            $quantity = $items -> getDetails() -> get('items') -> get($key) -> get('quantity');            
           // $saveamount = $items -> getDetails() -> get('items') -> get($key) -> get('extra_info') -> get('saveamount');
           // $normaldiscount = $totalSave + $saveamount['saveamount']*$quantity;
            //$totalSave = $totalSave + $saveamount['saveamount']*$quantity + $discountPrice;

            //normal discount
           
            $subtoal =$items-> getDetails() -> get('total');
            $tolalamount =$items-> getDetails() -> get('total') - $discountPrice;
            
        } 
        
        // echo $tolalamount;
        // die;
        
        $discountoption =' ';
        foreach($discount as $key => $item){

                $discountoption .='<li>
                <span>'.$item->name.'</span>
                <span>$ '.number_format($item->amount, 2).'</span>
              </li>';
        }



                        echo '<div class="order_summary">
                        <h4>ORDER SUMMARY</h4>
                           <ul class="orderDetails">
                           <li>
                             <span>Subtotal</span>
                             <span>$'.$subtoal.'</span>
                           </li>
                           
                            '. $discountoption .'
                           
                          
                         </ul>
                         <div class="totalPrice">
                           <strong>Total </strong>
                           <span>$'.$tolalamount.'</span>
                         </div> 
                         <div class="product_details mt-5 borderOrdd">
                           <ul class="ps-0">
                               <div class="row">
                                   <div class="col-md-6">
                                     <li><img src="https://gianzz.com/frontend/images/free-delivery.png" alt="">Fast Free Shipping</li>
                                     <li><img src="https://gianzz.com/frontend/images/fast.png" alt="">Fast Express Shipping</li>
                                     <li><img src="https://gianzz.com/frontend/images/returning.png" alt="">Hassle Free Return</li>
                                     <li><img src="https://gianzz.com/frontend/images/checkmark.png" alt="">Authenticity Guaranteed</li>
                                                                      </div>
                                   <div class="col-md-6">
                                   <li><img src= "https://gianzz.com/frontend/images/shield.png" alt="">Safe &amp; Secure Checkout</li>
                                     <li><img src="https://gianzz.com/frontend/images/available.png" alt="">In Stock and Ready to Ship</li>
                                   </div>
                               </div>
                             </ul>
                         </div>
                         <div class="CheckoutBtn">
                           <a href='.url('/checkout').' class="customButton">Checkout</a>
                         </div>
                       </div> ';
     }



    public function order_update_quantities(Request $request){
        $lastQt = $request -> get('latestQnt');
        $hashCode = $request -> get('hashCode');
        $cart = Cart::name('shopping');  
        $updatedItem = $cart->updateItem($hashCode, [
            'quantity'      => $lastQt,
        ]);

        $this -> getOrdersummery();

    }
}
