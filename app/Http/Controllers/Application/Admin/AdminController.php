<?php

namespace App\Http\Controllers\Application\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Image;

class AdminController extends Controller
{
     public function dashboard() {
        Session::put('page','dashboard');
        return view('Admin-view.dashboard');
    }

    public function login(Request $request) {
      //  return "hi";
        //echo $password = Hash::make('pc150x');die;
//        if(['middleware'=>['admin']]){
//            return redirect('admin/dashboard');
//        }
        if ($request->isMethod('post')) {

            $rules = [
                'email' => 'required|email|max:150',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Email address is required',
                'email.email' => 'Valid email address is required',
                'password.required' => 'Password is required',
            ];
            $this->validate($request, $rules, $customMessages);
            $credentials = array('email' => $request['email'], 'password' => $request['password']);
            if (Auth::guard('web_admin')->attempt($credentials)) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('flash_message', trans('messages.10'));             
            }
        }
        return view('Admin-view.login');
    }

    public function editAdminPassword() {
        Session::put('page','update-admin-password');        
        $adminDetails = Auth::guard('web_admin')->user();
        return view('Admin-view.Setting.editAdminPassword', ['adminDetails' => $adminDetails]);
    }

    public function chkCurrentPassword(Request $request) {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('web_admin')->user()->password)) {
            echo trans('labels.8');
        } else {
            echo trans('labels.9');
        }
    }

    public function updateCurrentPassword(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_pwd'], Auth::guard('web_admin')->user()->password)) {
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    admin::where('id', Auth::guard('web_admin')->user()->id)
                            ->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', trans('messages.13'));
                } else {
                    Session::flash('error_message', trans('messages.12'));
                }
            } else {
                Session::flash('error_message', trans('messages.11'));
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function logout() {
        Auth::guard('web_admin')->logout();
        return redirect('admin');
    }

    public function updateAdminDetails(Request $request) {
        Session::put('page','update-admin-details');        
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
                'admin_image.image' => 'Valid Image is required',
            ];
            $this->validate($request, $rules, $customMessages);

            /* Upload Image */
            if ($request->hasFile('admin_image')) {
                $image_temp = $request->file('admin_image');
                if ($image_temp->isValid()) {
                    /* get  Image Extension */
                    $extension = $image_temp->getClientOriginalExtension();
                    /* get  New image name */
                    $image_name = rand(111, 999999) . '.' . $extension;
                    $destinationPath = public_path() . trans('labels.5');
                    $imagePath = $destinationPath . $image_name;
                    /* Upload the Image */
                    Image::make($image_temp)->resize(300,400)->save($imagePath);
                } elseif (!empty($data['current_admin_image'])) {
                    $image_name = $data['current_admin_image'];
                } else {
                    $image_name = "";
                }
            }
            admin::where('email', Auth::guard('web_admin')->user()->email)
                    ->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $image_name]);
            Session::flash('success_message', trans('messages.14'));
            return redirect()->back();
        }

        // $adminDetails = Auth::guard('web_admin')->user(); ,['adminDetails' => $adminDetails]    
        return view('Admin-view.Setting.adminDetails');
    }

}
