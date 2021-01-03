@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.EditCategories') }} <small>{{ trans('labels.EditCategories') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/categories/display')}}"><i class="fa fa-database"></i> {{ trans('labels.Categories') }}</a></li>
            <li class="active">{{ trans('labels.EditCategories') }}</li>
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
                        <h3 class="box-title">{{ trans('labels.EditCategories') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                    @if (count($errors) > 0)
                                      @if($errors->any())
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first()}}
                                      </div>
                                      @endif
                                    @endif
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/categories/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('id', $result['editSubCategory'][0]->id , array('class'=>'form-control', 'id'=>'id')) !!}

                                        @foreach($result['description'] as $description_data)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Name') }} (English)</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="text" name="category_name" class="form-control field-validate" value="{{$description_data['name']}}">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryName') }} (English).</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.slug') }} </label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="hidden" name="old_slug" value="{{$result['editSubCategory'][0]->slug}}">
                                                <input type="text" name="slug" class="form-control field-validate" value="{{$result['editSubCategory'][0]->slug}}">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.slugText') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>

                                    

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="categories_status">
                                                  <option value="1" @if($result['editSubCategory'][0]->categories_status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                                  <option value="0" @if($result['editSubCategory'][0]->categories_status=='0') selected @endif>{{ trans('labels.Inactive') }}</option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Choose Parent Category </label>
                                            <div class="col-sm-10 col-md-4">
                                              <select class="form-control" name="parent_id">
                                                    {{-- <option value="0">Leave as Parent</option> --}}
                                                    @foreach ($result['categories'] as $item)
                                                    <option value="{{$item->id }}" 
                                                        @if ($item->id== $result['editSubCategory'][0]->parent_id) selected  @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                              </select>
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                            Choose parent Category. Leave as parent if this is a parent category.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/categories/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                            </div>
                            <!-- /.box-footer -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.box-body -->

        <!-- /.box -->

        <!-- /.col -->

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
