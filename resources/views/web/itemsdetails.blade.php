@extends('web.layouts.master')
@push('style')
<style>
    .btnbk {
  position: absolute;
  top: 5%;
  left: 10%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: left;
}

.btnbk:hover {
  background-color: black;
}}
</style>
@endpush
@section('contents')

<div class="container">
  <img src="{{asset($menuitems[0]->imgpath)}}" class = "img-fluid" alt="Responsive image">
  <a href="javascript:history.back()" class="btn btn-danger btn-sm btnbk"><i class="fa fa-home" aria-hidden="true"></i></a>
  <div class="text-center mt-4">
      @if ($menuitems[0]->is_new==1)
      <small class="badge badge-pill badge-danger">New</small>
      @endif
        <h1>{{$menuitems[0]->item_name}}</h1> 
    <h1>{{$menuitems[0]->item_price}}</h1>
  </div>
  <div class="text-center mt-2"> 
    <span style="font-size: larger;"><?=stripslashes($menuitems[0]->item_description)?> </span>
  </div>

  @if (count($extras)>0)
  <div class="text-left mt-2">
    <h3>EXTRAS</h3>
    {{$menuitems[0]->item_name}} ADD ONS

    @foreach ($extras as $item)
    <div class="radio">
        <label><input type="radio" name="optradio"> {{ $item->extra_options_name}}</label>
        <span style="margin-left: 150px;">Tk. {{ $item->extra_options_price}}</span>
    </div>
    @endforeach
    

  </div>
  @endif
  

</div>

@push('scripts')

@endpush
  

@endsection