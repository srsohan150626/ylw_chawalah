@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Menuitems <small>Add Menuitems...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/menuitems/display')}}"><i class="fa fa-database"></i> Listing all Menuitems</a></li>
            <li class="active">Add Menuitems</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Menuitems </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-success" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        {!! Form::open(array('url' =>'admin/menuitems/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        <div class="row">
                                            
                                               <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Category </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="categories_id">
                                                                <option value="">Select Category</option>
                                                                @foreach ($result['categories'] as $categories)
                                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                                @endforeach
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                Choose category at least one category.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Item Type<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control field-validate prodcust-type" name="item_type">
                                                                <option value="">{{ trans('labels.Choose Type') }}</option>
                                                                <option value="0">{{ trans('labels.Simple') }}</option>
                                                                <option value="1">{{ trans('labels.Variable') }}</option>
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                Choose Variable for Add Addons with this Item otherwise chhose simple.</span>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                               
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Item Name<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('item_name', '', array('class'=>'form-control', 'id'=>'item_name')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductPriceText') }}
                                                        </span>
                                                        <span class="help-block hidden">Enter Item Name In English</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Item Price<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('item_price', '', array('class'=>'form-control number-validate', 'id'=>'item_price')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductPriceText') }}
                                                        </span>
                                                        <span class="help-block hidden">Please enter only numreic value.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 ">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}<span style="color:red;">*</span></label>
                                                    {!! Form::file('image', old('image'), ['class'=>'input-file uniform_on', 'id'=>'fileInput', 'placeholder'=>'Select File']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="item_status" required>
                                                            <option value="1">{{ trans('labels.Active') }}</option>
                                                            <option value="0">{{ trans('labels.Inactive') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.SelectStatus') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row " style="margin-top: 20px;">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Is New?<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate prodcust-type" name="is_new">
                                                            <option value="0">No</option>
                                                            <option value="1">Yes</option>
                                                            
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please choose 'yes' to set new with this item..</span>
                                                    </div>
                                                </div>
                                                </div>
                                            

                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#product" data-toggle="tab">English<span style="color:red;">*</span></a></li>
                                                        
                                                    </ul>
                                                    <div class="tab-content">

                                                        <div style="margin-top: 15px;" class="tab-pane active" id="product_1">
                                                            <div class="">

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }}<span style="color:red;">*</span> (English)</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="editor" name="item_description" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            Enter Item description in English</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#product" data-toggle="tab">English<span style="color:red;">*</span></a></li>
                                                        
                                                    </ul>
                                                    <div class="tab-content">

                                                        <div style="margin-top: 15px;" class="tab-pane active" id="product_1">
                                                            <div class="">

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Ingredients<span style="color:red;">*</span> (English)</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="editor_ingrad" name="ingredients" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            Enter Menu Ingredients in English</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary ">
                                                <span>Save</span>
                                            </button>
                                            <a href="{{ URL::to('admin/menuitems/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                        </div>

                                        <!-- /.box-footer -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        CKEDITOR.replace('editor');
        $(".textarea").wysihtml5();

    }); 
</script>

<script type="text/javascript">
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        CKEDITOR.replace('editor_ingrad');
        $(".textarea").wysihtml5();

    }); 
</script>
@endsection
