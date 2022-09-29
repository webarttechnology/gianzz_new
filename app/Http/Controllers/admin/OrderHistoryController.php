<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Rope_chain;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class OrderHistoryController extends Controller
{
    public function list(Request $request){
        if($request ->method() == 'GET'){
            $data = Order:: all();
            $invoice = Invoice::get();
            $blog = Blog::get();
            //  echo "<pre/>";
            //  print_r($invoice);die;
            return view('admin/order/order-list',['order'=>$data, 'invoice' => $invoice, 'blog' => $blog,'title' =>"Order"]);
        }
    }
}
