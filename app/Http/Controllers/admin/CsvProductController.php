<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Categary;
use App\Models\Subcategary;
use App\Models\Rope_chain;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class CsvProductController extends Controller
{
    public function add(Request $request){
         if($request->method() == "GET"){
            $categary = Categary::get();
            $sub_categary = Subcategary::get();
           return view('admin/product/csv',['title' =>"Csv Product",'categary' => $categary, 'subCategary' => $sub_categary,]);
         }
    }

    public function fileupload(Request $request){
        if($request->method() == "POST"){
            $file = $request->file('csvfile');
            // echo "<pre/>";
            //  print_r($file);die;

            $request->validate([
                'categary_id'  =>'required',
                'csvfile' =>'required'
 
            ]);

              // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            $allowedColNum = 16;
            $batchcount=0;
            $filename = fopen($file, "r"); 

            $importData_arr = array();
            $i = 0;
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
                while ($line = fgetcsv($filename)){

                    $numcols = count($line);
                    // Bail out of the loop if columns are incorrect
                    // if ($numcols != $allowedColNum) {
                    //     return Redirect::to('/author/csv/product/add')-> with('errmsg',"CSV file coloum must be 16")->withInput($request->all);
                    // }
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if($i == 0){
                        $i++;
                        continue; 
                    }
                    for ($c=0; $c < $numcols; $c++) {
                        $importData_arr[$i][] = $line [$c];
                     }
                     $i++;

                    
                }
               
                  fclose($filename);
                  
                    $insertStatus=false;
        
                    // Insert to MySQL database
                
                    foreach($importData_arr as $importData){
                      
                            $title = $importData[1];
                            $description = $importData[2];
                            $imageLink = $importData[3];
                            $categary = $importData[4];
                            $skuCode = explode('-',$importData[5]);
                            $variationName = $importData[6];
                            $carat = $importData[7];
                            $color = $importData[9];
                            $amount = $importData[10];
                            $slug = Str::slug($importData[1], '-');   
                                                     
                            $duplicateSkuCodeyCheck = Blog::select('id','sku_code')->where('sku_code',$skuCode[0])->count();

                            $save_name = time()."image1.jpg";                          

                            $save_directory = "uploads/";    
                            if(is_writable($save_directory)) {
                                file_put_contents($save_directory . $save_name, file_get_contents($imageLink));
                            }else {
                                echo "error";
                            } 

                            if($duplicateSkuCodeyCheck == 0){

                              

                                $product = new Blog([
                                    "tittle"=>$title,
                                    "description"=>$description,
                                    "image"=>"uploads/".$save_name,                                   
                                    "name"=>$title,
                                    "is_variation" => "1",
                                    'sku_code'=>$skuCode[0],
                                    'categary_id'=>$request->categary_id,
                                    'slug_name'=>$slug   
                                ]);

                                $productList = $product -> save();

                               

                               
                            
                                if($product -> id){
                                    $ropeChain = Rope_chain::create([         
                                        'name' =>$variationName,
                                        'blog_id' =>$product -> id,
                                        'gold_color' => $color,
                                        'amount' => $amount,
                                        'discount_percentage'=> 0,
                                        'discount_amt' =>0.00,
                                        'final_price' =>$amount,
                                        'carat' => $carat,
                                        "image"=>"uploads/".$save_name,
                                    ]);                                 

                                }
                              
                            }else{

                                $productDetails = Blog::where(['sku_code'=> $skuCode[0]])->first();

                                $ropeChain = Rope_chain::create([         
                                    'name' =>$variationName?$variationName:'N/A',
                                    'blog_id' =>$productDetails -> id,
                                    'gold_color' => $color?$color:'N/A',
                                    'amount' => $amount,
                                    'discount_percentage'=> 0,
                                    'discount_amt' =>0.00,
                                    'final_price' =>$amount,
                                    'carat' => $carat?$carat:'N/A',
                                    "image"=>"uploads/".$save_name,
                                ]); 

                               

                            }
                                
                        

                           


                        // }else{
                        //     return Redirect::to('/author/product')-> with('errmsg',"Already Exist This Product")->withInput($request->all);
                        // }


                    }
                    if($insertStatus==true){
                        return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.ADD_SUCCESS'));
                    }else{
                        return Redirect::to('/author/product')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
                    }

                    // Session::flash('message','Import Successful.');

            }else{
                die;
                return Redirect::to('/author/product')-> with('errmsg',"File must be CSV")->withInput($request->all);
            }
        }

    }


}
