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
        <form role="form" method="post" action="{{url('/admin/update-current-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
            @csrf
            <!-- text input -->
            <div class="form-group">
                <label>{{trans('labels.10').' '.trans('labels.14')}}</label>
                <input type="text" class="form-control" value="{{$adminDetails->name}}" readonly=""/> 
            </div>
            <div class="form-group">
                <label>{{trans('labels.10').' '.trans('labels.15')}}</label>
                <input type="text" class="form-control" value="{{$adminDetails->email}}" readonly=""/>
            </div>
            <div class="form-group">
                <label>{{trans('labels.10').' '.trans('labels.16')}}</label>
                <input type="text" class="form-control" value="{{$adminDetails->type}}" readonly=""/>
            </div>
            <div class="form-group">
                <label>{{trans('labels.17').' '.trans('labels.13')}}</label>
                <input type="text" name="current_pwd" id="current_pwd" class="form-control" placeholder=" {{trans('labels.20').' '.trans('labels.17').' '.trans('labels.16')}}">
            </div>
            <div class="form-group">
                <label>{{trans('labels.18').' '.trans('labels.13')}}</label>
                <input type="text" name="new_pwd" id="new_pwd" class="form-control" placeholder="{{trans('labels.20').' '.trans('labels.17').' '.trans('labels.13')}}">
            </div>
            <div class="form-group">
                <label>{{trans('labels.19').' '.trans('labels.13')}}</label>
                <input type="text"  name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="{{trans('labels.19').' '.trans('labels.18').' '.trans('labels.13')}}">
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