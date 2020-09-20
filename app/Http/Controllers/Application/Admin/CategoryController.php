<?php

namespace App\Http\Controllers\Application\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller {

    private $result = false;
    private $message = false;
    private $details = false;
    private $value = false;
    private $total_row = false;
    private $validator_error = false;

    public function categories() {
        Session::put('page', 'categories');
//        $categories = Category::with(['section'=>  function($query){
//            $query->select('id','name');
//        }])->get();
        $categories = Category::with(['section', 'parentcategory'])->get();
        //$categories = json_decode(json_encode($categories), true);   
        //return $categories;
        return view('Admin-view.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            Category::where('id', $data['category_id'])->update(['status' => $data['status']]);
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

    public function addEditCategory(Request $request, $id = null) {
        if ($id == "") {
            $title = "Add Category";
            $category = new Category();
            $categorydata = array();
            $getCategories = array();
            $this->message = trans('messages.5');
        } else {
            $title = "Edit Category";
            $val = explode("||", base64_decode($id));
            $cat_id = $val[0];
            $categorydata = Category::where('id', $cat_id)->first();
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $categorydata->section_id])->get();
            $category = Category::findOrFail($cat_id);
            $this->message = trans('messages.16');
        }
        //print_r($getCategories);dd();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
                        'parent_id' => 'required|numeric',
                        "section_id" => 'required',
                        "category_discount" => 'required|numeric',
                        "category_description" => 'required',
                        "category_url" => 'required',
                        "meta_title" => 'required',
                        "meta_description" => 'required',
                        "meta_keywords" => 'required',
                            // "category_image" => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            //$image_name = "";
            if ($request->hasFile('category_image')) {
                $image_temp = $request->file('category_image');
                if ($image_temp->isValid()) {
                    /* get  Image Extension */
                    $extension = $image_temp->getClientOriginalExtension();
                    /* get  New image name */
                    $image_name = rand(111, 999999) . '.' . $extension;
                    $destinationPath = public_path() . trans('labels.100');
                    $imagePath = $destinationPath . $image_name;
                    /* Upload the Image */
                    Image::make($image_temp)->resize(300, 400)->save($imagePath);
                    $category->category_image = $image_name;
                }

//                elseif (!empty($data['category_image'])) {
//                    $image_name = $data['category_image'];
//                } else {
//                    $image_name = "";
//                }
            }
            $data = $request->all();
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = (!empty($data['category_discount'])) ? $data['category_discount'] : "";
            $category->description = (!empty($data['category_description'])) ? $data['category_description'] : "";
            $category->url = $data['category_url'];
            //$category->category_image = $image_name;
            $category->meta_title = (!empty($data['meta_title'])) ? $data['meta_title'] : "";
            $category->meta_description = (!empty($data['meta_description'])) ? $data['meta_description'] : "";
            $category->meta_keywords = (!empty($data['meta_keywords'])) ? $data['meta_keywords'] : "";
            $category->status = 1;
            $result = $category->save();
            if ($result == true) {
                return redirect('admin/categories')->with('success_message', $this->message);
            } else {
                return redirect()->back()->with('success', trans('messages.6'));
            }
        }
        $getSection = Section::get();
        return view('Admin-view.categories.add_edit_category')->with(compact('title', 'getSection', 'categorydata', 'getCategories'));
    }

    public function appendCategoriesLevel(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $condition = array('section_id' => $data['section_id'], 'status' => 1, 'parent_id' => 0);
            $getCategories = Category::with('subcategories')->where($condition)->get();
            // dd($getCategories);
            // $getCategories = json_decode(json_encode($getCategories), true);            
            return view('Admin-view.categories.append_categories_level')->with(compact('getCategories'));
        }
    }

    public function deleteCategoriesImage($id) {
        $val = explode("||", base64_decode($id));
        $cat_id = $val[0];
        $categorydata = Category::where('id', $cat_id)->first();
        //dd($categorydata);

        $path = public_path() . trans('labels.100') . $categorydata->category_image;
        if (file_exists($path) && !empty($categorydata->category_image)) {
            unlink($path);
        }
        Category::where('id', $cat_id)->update(['category_image' => ""]);
        return redirect()->back()->with('success_message', trans('messages.18'));
    }

    public function deleteCategories($id) {
        $val = explode("||", base64_decode($id));
        $cat_id = $val[0];
        $categorydata = Category::where('parent_id', $cat_id)->first();
        //dd($categorydata);
        //  if(empty($categorydata)){ return 1; }else{ return 2;}
        if (empty($categorydata)) {
            $categorydata = Category::where('id', $cat_id)->first();
            //dd($categorydata);            
            $path = public_path() . trans('labels.100') . $categorydata->category_image;
            if (file_exists($path) && !empty($categorydata->category_image)) {
                unlink($path);
            }
            Category::where('id', $cat_id)->delete();
            return redirect()->back()->with('success_message', trans('messages.8'));
        } else {
            return redirect()->back()->with('error_message', trans('messages.19'));
        }
    }

}
