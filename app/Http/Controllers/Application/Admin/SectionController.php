<?php

namespace App\Http\Controllers\Application\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    //
    private $result = false;
    private $message = false;
    private $details = false;
    private $value = false;
    private $total_row = false;
    private $validator_error = false;

    public function sections() {
        // dd('gi');
        Session::put('page', 'sections');
        $sections = Section::get();
        return view('Admin-view.Sections.section')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            Section::where('id', $data['section_id'])->update(['status' => $data['status']]);
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

    public function addSection(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'section_name' => 'required',
                        'section_status' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $section = new Section();
            $section->name = $request->input('section_name');
            $section->status = $request->input('section_status');
            $result = $section->save();
            if ($result == true) {
                return redirect('admin/sections')->with('success_message', trans('messages.5'));
            } else {
                return redirect()->back()->with('success', trans('messages.6'));
            }
        }
        return view('Admin-view.Sections.section_new');
    }
     public function editSection($section_id) {
           $val = explode("||", base64_decode($section_id));
            $id = $val[0];
            $sectionDetails =  Section::findOrFail($id);
            return view('Admin-view.Sections.section_edit',['sectionDetails' => $sectionDetails]);        
    }
    public function updateSection(Request $request){
        if ($request->isMethod('post')) {
             $data = $request->all();           
            $validator = Validator::make($request->all(), [
                        'section_name' => 'required',
                        'section_status' => 'required|numeric',
                         'section_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $section = Section::findOrFail($request->input('section_id'));
            $section->name = $request->input('section_name');
            $section->status = $request->input('section_status');
            $result = $section->save();
            if ($result == true) {
                return redirect('admin/sections')->with('success_message', trans('messages.16'));
            } else {
                return redirect()->back()->with('error', trans('messages.17'));
            }
        }  
        
    }

    public function deleteSection($data){
        $val = explode("||", base64_decode($data));
        $id = $val[0];
        $result = Section::where('id', $id)->delete();
        if($result == true){
            Session::flash('success_message', trans('messages.8'));
         return redirect()->back();
        }else{
         Session::flash('error', trans('messages.9'));
         return redirect()->back();
        }        
    }
}
