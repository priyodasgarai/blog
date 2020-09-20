@extends('../../master-layout/admin_master')


@section('title')
<title>{{trans('labels.10').trans('labels.11')}}</title>
@endsection



@section('Main-content-header')
<h1>{{trans('labels.11')}}</h1>
<!--<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
</ol>-->

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


@section('Main-content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title default">{{trans('labels.12').trans('labels.13')}}</h3>

        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="box-body">
        <form role="form" method="post" action="{{url('/admin/update-admin-details')}}" name="updatePasswordForm" id="updatePasswordForm" enctype="multipart/form-data">
            @csrf
            <!-- text input -->
            
            <div class="form-group">
                <label>{{trans('labels.10').' '.trans('labels.15')}}</label>
                <input type="text" class="form-control" value="{{Auth::guard('web_admin')->user()->email}}" readonly=""/>
            </div>
            <div class="form-group">
                <label>{{trans('labels.10').' '.trans('labels.16')}}</label>
                <input type="text" class="form-control" value="{{Auth::guard('web_admin')->user()->type}}" readonly=""/>
            </div>
            <div class="form-group">
                <label>{{trans('labels.14')}}</label>
                <input type="text" name="admin_name" id="admin_name" value="{{Auth::guard('web_admin')->user()->name}}" class="form-control" placeholder=" {{trans('labels.20').' '.trans('labels.10').' '.trans('labels.14')}}">
            </div>
            <div class="form-group">
                <label>{{trans('labels.23')}}</label>
                <input type="text" name="admin_mobile" id="admin_mobile" value="{{Auth::guard('web_admin')->user()->mobile}}" class="form-control" placeholder="{{trans('labels.20').' '.trans('labels.10').' '.trans('labels.23')}}">
            </div>
            <div class="form-group">
                <label>{{trans('labels.24')}}</label>
                <input type="file"  name="admin_image" id="admin_image" class="form-control" accept="image/*">
                @if(!empty(Auth::guard('web_admin')->user()->image))
                <a target="_blank" href="{{url(trans('labels.6').Auth::guard('web_admin')->user()->image)}}">View Image</a>
                <input type="hidden" name="current_admin_image" value="{{Auth::guard('web_admin')->user()->image}}">
                @endif
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