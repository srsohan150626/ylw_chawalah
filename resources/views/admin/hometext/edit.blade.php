@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>HomeText <small>Edit HomeText...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/hometexts/display')}}"><i class="fa fa-database"></i>HomeText</a></li>
            <li class="active">Edit HomeText</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit HomeText </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <br>
                                    @if (count($errors) > 0)
                                    @if($errors->any())
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{$errors->first()}}
                                    </div>
                                    @endif
                                    @endif
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/hometexts/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('id', $hometext[0]->id , array('class'=>'form-control', 'id'=>'id')) !!}

                                        <div class="form-group">

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
                                                                        <label for="name" class="col-sm-2 col-md-3 control-label">UpperText<span style="color:red;">*</span> (English)</label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <textarea id="editor" name="upper_text" class="form-control" rows="5"><?=stripslashes($hometext[0]->upper_text)?></textarea>
                                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                                Enter UpperText in English</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

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
                                                                        <label for="name" class="col-sm-2 col-md-3 control-label">LowerText<span style="color:red;">*</span> (English)</label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <textarea id="editorlower" name="lower_text" class="form-control" rows="5"><?=stripslashes($hometext[0]->lower_text)?></textarea>
                                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                                Enter LowerText in English</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="status">
                                                <option  @if ($hometext[0]->status==1) selected @endif value="1">{{ trans('labels.Active') }}</option>
                                                <option @if ($hometext[0]->status==0) selected @endif value="0">{{ trans('labels.Inactive') }}</option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                            <a href="{{ URL::to('admin/hometexts/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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

    $(function() {

    //bootstrap WYSIHTML5 - text editor
    CKEDITOR.replace('editorlower');
    $(".textarea").wysihtml5();

    });
</script>
@endsection
