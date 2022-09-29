<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\Invoice;
use App\Models\Order;
use Jackiedo\Cart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request){     
        if($request -> method() =='GET') { 
            $items = Cart::name('shopping')->getItems();
            if(count($items) != 0){
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
                return view('checkout',['addtocart' =>$newarray, 'userData' => Registration::where('id', $request -> session() -> get('frontendloginID')) -> first()]);
            }else{
                return Redirect::to('shop/all');
            }
        }else if($request ->method() == 'POST'){

          //print_r($request->post());
        
            $user_id = $request->session() ->get('frontendloginID');
            $items = Cart::name('shopping')->getItems();
            if(count($items) != 0){
                $request->validate([
                    'emailid'  =>'required|email',
                    'fname'  =>'required',
                    'address' =>'required',
                    'address1' =>'required',
                    'city' =>'required',
                    'country' =>'required',
                    'state' =>'required',
                    'pincode' =>'required',
                    'mobile_no' =>'required',
                    
                ]);
               
                $lastinvoiceno =Invoice::orderBy('id', 'DESC')->first();
                
            
                $invoice = new Invoice([
                    'total_amt' =>$request->total_amt,
                    'pay_amt' =>$request->pay_amt,
                    'registration_id'=>$user_id,
                    'save_amt'=>$request->save_amt,
                    'spl_discount'=>$request->spl_discount,
                    'invoice_no' =>'',
                    'order_no' =>''
                ]);
                
                
                 

                if( $invoice -> save()){
                    $lastId = $invoice -> id;
                    if(strlen($lastId) == 1){
                        $invoiceNO = 'IN00000'.$lastId;
                        $orderID ='ORD00000'.$lastId;
                    }else if(strlen($lastId) == 2){
                        $invoiceNO = 'IN0000'.$lastId;
                        $orderID ='ORD0000'.$lastId;
                    }else if(strlen($lastId) == 3){
                        $invoiceNO = 'IN000'.$lastId;
                        $orderID ='ORD000'.$lastId;
                    }else if(strlen($lastId) == 4){
                        $invoiceNO = 'IN00'.$lastId;
                        $orderID ='ORD00'.$lastId;
                    }else if(strlen($lastId) == 5){
                        $invoiceNO = 'IN0'.$lastId;
                        $orderID ='ORD0'.$lastId;
                    }else if(strlen($lastId) == 6){
                        $invoiceNO = 'IN'.$lastId;
                        $orderID ='ORD'.$lastId;
                    }
                
                    $update_data = Invoice::where('id', $lastId)->update([
                        'invoice_no' =>$invoiceNO,
                        'order_no' =>$orderID
                    ]);
                
                        if($update_data){
                            $items = Cart::name('shopping')->getItems();
                            foreach ($items as  $item) {                           
                                $price =$item->getExtra_info();
                                $option =$item->getOptions();
                                $order = Order::create([
                                    'invoice_id' =>$lastId,
                                    'blog_id' =>$item->getId(),
                                    'registration_id'=>$user_id,
                                    'email_id' =>$request->emailid,
                                    'fname' =>$request->fname,
                                    'company' =>$request->company,
                                    'address' =>$request->address,
                                    'address1' =>$request->address1,
                                    'city' =>$request->city,
                                    'country' =>$request->country,
                                    'state' =>$request->state,
                                    'pincode' =>$request->pincode,
                                    'mobile_no' =>$request->mobile_no,
                                    'final_price' =>$item->getPrice(),
                                    'discount_amt' =>$price['saveamount']['saveamount'],
                                    'amount' =>$price['amount']['amount'],
                                    'quantatity' =>$item->getQuantity(),
                                    'color' =>$option['color']['label'],
                                    'size' =>$option['size']['label']
                                ]);
                            
                            }if($order){
                                Cart::name('shopping')->clearItems();
                                $request -> session() -> put('invoiceno', $invoiceNO);
                                return redirect::to('handle-payment');
                                // return Redirect::to('thank-you/'.$lastId);
                            }
                        
                        }
                    
                }
            }else{
                return Redirect::to('shop/all');
            }



        }

    }



    public function getOrdersummery(){

        $items = Cart::name('shopping');   

    
        $totalSave = 0;
        $getItems = $items -> getItems();

        $today=date("Y-m-d");
        $discount    =DB::table('discounts')->where('start_date','<=',$today)
                  ->where('end_date','>=',$today)->get();
        //   print_r($discount->amount);die;
       
        $discountPrice = 0;
        foreach ($discount as $sum){
            $discountPrice+=$sum->amount;
        }
        // echo $discountPrice;
        // die;



        foreach($getItems as $key => $val){ 
            $quantity = $items -> getDetails() -> get('items') -> get($key) -> get('quantity');            
            $saveamount = $items -> getDetails() -> get('items') -> get($key) -> get('extra_info') -> get('saveamount');
            $normaldiscount = $totalSave + $saveamount['saveamount']*$quantity;
            $totalSave = $totalSave + $saveamount['saveamount']*$quantity + $discountPrice;

            //normal discount
           

            $tolalamount =$items-> getDetails() -> get('total') - $discountPrice;
            
        }   
        
        $discountoption =' ';
        foreach($discount as $key => $item){
                $discountoption .='<div class="d-flex justify-content-between py-2">
                <h5 class="mb-0 text-black fs-5">'.$item->name.' Offer  </h5>
                <h5 class="mb-0 text-theme-red fs-5">- $ '.number_format($item->amount, 2).'</h5>
                </div>';
        }
     
        echo '<div class="summarybox">
                <h4 class="fs-5 lh-base text-theme-red text-uppercase mb-4">Order summary</h4>	
                    <div class="d-flex justify-content-between py-2">
                        <h5 class="mb-0 text-black fs-5">Total price <span class="text-theme-grey fs-6">('.$items -> getDetails() -> get('items_count').' Items)</span></h5>
                        <h5 class="mb-0 text-theme-red fs-5">$ '.number_format($items-> getDetails() -> get('total'), 2).'</h5>
                    </div>	 '. $discountoption.'
                  					
                    <div class="d-flex justify-content-between py-3">
                        <h5 class="text-black fs-5">Total Payable <span class="text-theme-grey fs-6">('.$items -> getDetails() -> get('items_count').' Items)</span></h5>
                        <h5 class="text-theme-red fs-5">$ '.number_format($tolalamount, 2).'</h5>
                    </div>
                   
                    <input type="hidden"  id="total_amt" value="'.number_format($items-> getDetails() -> get('total'), 2).'" />
                    <input type="hidden"  id="pay_amt" value="'.number_format($tolalamount, 2).'" />
                       
                        <input type="hidden"  id="spl_discount" value="'.$discountPrice.'" />
            
                    <div class="sub_title mb-3 mt-4 text-center">All orders are processed in USD. While the content of your cart is currently displayed in , you will checkout using USD at the most current exchange rate.</div>
            </div>';
    }

    public function clearItems($withEvent = true){
        $items = Cart::name('shopping')->clearItems();
    }
}
