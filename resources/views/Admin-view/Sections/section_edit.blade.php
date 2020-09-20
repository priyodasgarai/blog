@extends('../../master-layout/admin_master')


@section('title')
<title>Update Section</title>
@endsection



@section('Main-content-header')
<h1>New Section</h1>
<!--<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
</ol>-->
@endsection

@section('Main-content')
<div class="box">
    <div class="box-header with-border">
         <h3 class="box-title">Edit section details</h3>
         <a  href="{{url('/admin/sections')}}" class="btn btn-mini btn-primary pull-right button_class">{{trans('labels.33')}}</a>
    </div>
    <div class="box-body">
        <form role="form" method="post" action="{{url('/admin/edit-section')}}" name="updateSection">
            @csrf
            <!-- text input -->
            <input type="hidden"  name="section_id" value="{{$sectionDetails->id}}" />
            <div class="form-group">
                <label>{{trans('labels.14')}}</label>
                <input type="text" class="form-control" name="section_name" value="{{$sectionDetails->name}}" />
            </div>
           <div class="form-group">
                  <label>Select</label>
                  <select class="form-control" name="section_status">
                       @if(!empty($sectionDetails->status))
                       @if($sectionDetails->status == 1)
                       <option value="1" selected>{{trans('labels.26')}}</option>
                       @else
                       <option value="1" selected>{{trans('labels.27')}}</option>
                       @endif
                       @endif                     
                      <option value="1">{{trans('labels.26')}}</option>
                    <option value="0">{{trans('labels.27')}}</option>
                    
                  </select>
                </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" placeholder="{{trans('labels.21')}}">
            </div>

        </form>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
@endsection



@section('Main-content-error-message')
@if(Session::has('flash_message'))  
<div class="alert alert-danger alert-dismissable show" role="alert">     
    {{Session::get('flash_message')}}
    <button type="button" class="close" data-dismiss="alert" aris-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{Session::forget('flash_message')}}
</div>
@endif
@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissable" role="alert">  
    {{Session::get('success_message')}}
    <button type="button" class="close" data-dismiss="alert" aris-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>    
</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-danger alert-dismissable show" role="alert">     
    {{Session::get('error_message')}}
    <button type="button" class="close" data-dismiss="alert" aris-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection

