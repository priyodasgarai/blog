<?php

namespace App\Http\Controllers\Application\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\Masterproduct;
use App\Models\Section;
use App\Models\Category;

class MasterproductController extends Controller
{
      public function masterproduct() {
//        $string = "guhg jh jh";
//        $result = Helper::shout($string);
//        dd($result);
        
        Session::put('page', 'master-product');
        $masterproduct = Masterproduct::with([
                    'section' => function($query) {
                        $query->select('id', 'name');
                    },
                    'category' => function($query) {
                        $query->select('id', 'category_name');
                    }
                ])->get();
        // print_r($masterproduct);die; http://localhost/TechnicalTest/admin/master-product
        return view('Admin-view.Masterproduct.masterproduct')->with(compact('masterproduct'));
    }

    public function updateMasterproductStatus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            Masterproduct::where('id', $data['masterproduct_id'])->update(['status' => $data['status']]);
            $this->result = true;
            $this->message = trans('messages.2');
        } else {
            $this->result = FALSE;
            $this->message = trans('messages.3');
        }
        return Response::make([
                    'result' => $this->result,
                    'message' => $this->message
        ]);
    }
    
    public function addEditMasterproduct(Request $request, $id = null) {
        if ($id == "") {
            $title = "Add Masterproduct";
            $masterproduct = new Masterproduct();
            $masterproductdata = array();
            $getMasterproduct = array();
            $this->message = trans('messages.5');
        } else {
            $title = "Edit Masterproduct";
            $val = explode("||", base64_decode($id));
            $product_id = $val[0];
            $masterproductdata =  Masterproduct::where('id',$product_id)->first();
           // $getMasterproduct = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata->section_id])->get();           
            $masterproduct = Masterproduct::findOrFail($product_id);
            $this->message = trans('messages.16');
        }
        
        $getSection = Section::get();
        return view('Admin-view.Masterproduct.add_edit_masterproduct')->with(compact('title', 'getSection'));
    }

    public function deleteMasterproductImage($id) {
        $val = explode("||", base64_decode($id));
        $product_id = $val[0];
        $masterproductdata = Masterproduct::where('id', $product_id)->first();
        //dd($categorydata);

        $path = public_path() . trans('labels.102') . $masterproductdata->main_image;
        if (file_exists($path) && !empty($masterproductdata->main_image)) {
            unlink($path);
        }
        Masterproduct::where('id', $product_id)->update(['main_image' => ""]);
        return redirect()->back()->with('success_message', trans('messages.8'));
    }

    public function deleteMasterproduct($id) {
        $val = explode("||", base64_decode($id));
        $product_id = $val[0];
        $masterproductdata = Masterproduct::where('id', $product_id)->first();
        //dd($categorydata);
        //  if(empty($categorydata)){ return 1; }else{ return 2;}
        if (!empty($masterproductdata)) {
            // $categorydata =  Category::where('id',$cat_id)->first();
            //dd($categorydata);            
            $path = public_path() . trans('labels.102') . $masterproductdata->main_image;
            if (file_exists($path) && !empty($masterproductdata->main_image)) {
                unlink($path);
            }
            Masterproduct::where('id', $product_id)->delete();
            return redirect()->back()->with('success_message', trans('messages.8'));
        } else {
            return redirect()->back()->with('error_message', trans('messages.7'));
        }
    }
}
