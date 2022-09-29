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
               // 'csvfile' =>'required|file|mimes:csv'
 
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

                    // count($line) is the number of columns
                    $numcols = count($line);
                    // Bail out of the loop if columns are incorrect
                    if ($numcols != $allowedColNum) {
                        return Redirect::to('/author/csv/product/add')-> with('errmsg',"CSV file coloum must be 16")->withInput($request->all);
                    }
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
                    echo "<pre/>";
                   print_r($importData_arr);
                    die;

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){
                        print_r(array_unique($importData_arr));
                        die;
                        $duplicateProductyCheck = Blog::where('name',$importData[8])->count();
                        if($duplicateProductyCheck == 0){
                             $slug = Str::slug($importData[8], '-');

                            $insertData =  Blog::create([
                                "tittle"=>$importData[1],
                                "description"=>$importData[2],
                                "image"=>$importData[3],
                                "image1"=>$importData[4]==''?NULL:$importData[4],
                                "image2"=>$importData[5]==''?NULL:$importData[5],
                                "image3"=>$importData[6]==''?NULL:$importData[6],
                                "image4"=>$importData[7]==''?NULL:$importData[7],
                                "name"=>$importData[8],
                                'sku_code'=>$importData[9],
                                'categary_id' =>$request->categary_id,
                                'slug_name'=>$slug

                            ]);

                            $ropeChain = Rope_chain::create([         
                                'name' =>$importData[8],
                                'blog_id' =>$insertData->id,
                                'gold_color' =>$importData[11],
                                'amount' =>$importData[12],
                                'discount_percentage'=>$importData[13],
                                'discount_amt' =>$importData[15],
                                'final_price' =>$importData[14]
                            ]);

                          

                        }else{
                            return Redirect::to('/author/product')-> with('errmsg',"Already Exist This Product")->withInput($request->all);
                        }


                    }
                    if($insertData){
                        return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.ADD_SUCCESS'));
                    }else{
                        return Redirect::to('/author/product')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
                    }

                    // Session::flash('message','Import Successful.');

            }else{
                return Redirect::to('/author/product')-> with('errmsg',"File must be CSV")->withInput($request->all);
            }
        }

    }


}
