@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Menuitems <small>Listing all the Menuitems...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> Menuitems</li>
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

                            <div CLASS="col-lg-12"> <h7 style="font-weight: bold; padding:0px 16px; float: left;">Filter by Category or Menuitem:</h7>

                                <br>
                           <div class="col-lg-10 form-inline">

                           <form action="{{route('menuitems.display')}}"  name='registration' id="registration" class="registration" method="get">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="input-group-form search-panel ">
                                        <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="categories_id">

                                            <option value="" selected disabled hidden>{{trans('labels.ChooseCategory')}}</option>
                                            @foreach ($results['categories'] as  $key=>$categories)
                                                <option value="{{ $categories->categories_id }}"
                                                        @if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id']))
                                                          @if( $categories->categories_id == $_REQUEST['categories_id'])
                                                            selected
                                                          @endif
                                                        @endif
                                                >{{ $categories->categories_slug }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="item" placeholder="Search term..." id="parameter"  @if(isset($item)) value="{{$item}}" @endif />
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        {{-- @if(isset($product,$categories_id))  <a class="btn btn-danger " href="{{url('admin/menuitems/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif --}}
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/menuitems/add') }}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>{{ trans('labels.Image') }}</th>
                                            <th>@sortablelink('categories_name', trans('labels.Category') )</th>
                                            <th>@sortablelink('item_name', trans('labels.Name') )</th>
                                            <th>{{ trans('labels.Additional info') }}</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($results['tot_item']>0)
                                            @php  $resultsItem = $results['menuitems']->unique('item_id')->keyBy('item_id');  @endphp
                                            @foreach ($results['menuitems'] as  $key=>$item)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>
                                                        {{-- <img src="{{asset($item->path)}}" alt="" height="50px"> --}}
                                                        <img src="{{URL::to('images/' . $item->item_image)}}" alt="" height="50px">
                                                    </td>
                                                    <td>
                                                        {{ $item->categories_name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td>
                                                        
                                                        <strong>{{ trans('labels.Price') }}: </strong>   
                                                        {{ $item->item_price }}
                                                        <br>
                                                        @if ($item->is_new==1)
                                                        <strong class="badge bg-light-green">New Item</strong><br>
                                                        @endif
                                                    </td>
                                                    <td> {!! str_limit(strip_tags($item->item_description), $limit = 40, $end = '...') !!} </td>
                                                    <td>
                                                      <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="{{url('admin/menuitems/edit')}}/{{ $item->item_id }}">Edit</a>
                                                      </br>
                                                      <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="{{ $item->item_id }}">Delete</a>
                                                      </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                                <div class="col-xs-12" style="background: #eee;">


                                  @php
                                    if($results['menuitems']->total()>0){
                                      $fromrecord = ($results['menuitems']->currentpage()-1)*$results['menuitems']->perpage()+1;
                                    }else{
                                      $fromrecord = 0;
                                    }
                                    if($results['menuitems']->total() < $results['menuitems']->currentpage()*$results['menuitems']->perpage()){
                                      $torecord = $results['menuitems']->total();
                                    }else{
                                      $torecord = $results['menuitems']->currentpage()*$results['menuitems']->perpage();
                                    }

                                  @endphp
                                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                                    <div>Showing {{$fromrecord}} to {{$torecord}}
                                        of  {{$results['menuitems']->total()}} entries
                                    </div>
                                  </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    {{$results['menuitems']->links()}}
                                </div>
                              </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- deleteProductModal -->
            <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteProductModalLabel">{{ trans('labels.DeleteProduct') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/menuitems/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteThisProductDiloge') }}?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteProduct">{{ trans('labels.DeleteProduct') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
