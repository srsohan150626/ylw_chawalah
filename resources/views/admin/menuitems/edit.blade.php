@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Edit Menuitems <small>Edit Menuitems...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/menuitems/display')}}"><i class="fa fa-database"></i> Listing all Menuitems</a></li>
            <li class="active">Edit Menuitems</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Menuitems </h3>
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

                                        {!! Form::open(array('url' =>'admin/menuitems/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                        {!! Form::hidden('id', $result['item'][0]->item_id, array('class'=>'form-control', 'id'=>'id')) !!}
                                        <div class="row">
                                            
                                               <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Category </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="categories_id">
                                                                <option value="">Select Category</option>
                                                                @foreach ($result['categories'] as $categories)
                                                                <option @if($result['itemsto_categories'][0]->categories_id == $categories->id )
                                                                    selected
                                                                    @endif value="{{ $categories->id }}" >{{ $categories->name }}</option>
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
                                                        {!! Form::text('item_name', $result['item'][0]->item_name, array('class'=>'form-control', 'id'=>'item_name')) !!}
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
                                                        {!! Form::text('item_price', $result['item'][0]->item_price, array('class'=>'form-control number-validate', 'id'=>'item_price')) !!}
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
                                                    <div class="float-left">
                                                        {!! Form::file('image', old('image'), ['class'=>'input-file uniform_on', 'id'=>'fileInput', 'placeholder'=>'Select File']) !!}
                                                    </div>
                                                    <div class="old-cat-img">
                                                        <img src="{{URL::to('images/' . $result['item'][0]->item_image)}}" alt="" width="50">
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::hidden('oldImage', $result['item'][0]->item_image , array('id'=>'oldImage', 'class'=>'field-validate ')) !!}
                                                        <img src="{{asset($result['item'][0]->item_image)}}" alt="" width=" 100px">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="item_status" required>
                                                            <option  @if ($result['item'][0]->item_status==1) selected @endif value="1">{{ trans('labels.Active') }}</option>
                                                            <option @if ($result['item'][0]->item_status==0) selected @endif value="0">{{ trans('labels.Inactive') }}</option>
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
                                                            <option value="">Choose</option>
                                                            <option @if ($result['item'][0]->is_new==1) selected @endif value="1">Yes</option>
                                                            <option @if ($result['item'][0]->is_new==0) selected @endif value="0">No</option>
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
                                                                        <textarea id="editor" name="item_description" class="form-control" rows="5"><?=stripslashes($result['item'][0]->item_description)?></textarea>
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
                                                                        <textarea id="editor_ingrad" name="ingredients" class="form-control" rows="5"><?=stripslashes($result['item'][0]->ingredients)?></textarea>
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
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary ">
                                                <span>Update</span>
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
