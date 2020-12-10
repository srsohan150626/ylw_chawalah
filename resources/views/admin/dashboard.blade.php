@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <small>Welcome to Admin Panel</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>
       <!-- Main content -->
       <section class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $total_category->count() }}</h3>
                        <p>Total Menu Category</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
            <a href="{{url('admin/categories/display')}}" class="small-box-footer" data-toggle="tooltip" data-placement="bottom" title="Menu Category">Menu Category <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $total_items->count() }}</h3>

                  <p>Total Menuitems</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
            <a href="{{url('admin/menuitems/display')}}" class="small-box-footer" data-toggle="tooltip" data-placement="bottom" title="View All Menuitems">View All Menuitems <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

          </div>
       </section>

    </div>
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/pages/dashboard2.js') !!}"></script>

@endsection
