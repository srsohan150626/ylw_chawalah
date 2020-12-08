@extends('web.layouts.master')
@push('style')
<style>
      body, html {
          height: 100%;
          margin: 0;
        }
    .bground {
          /* The image used */
          background-image: url("{{asset('web/img/tableabove10001499.jpg')}}");
        
          /* Full height */
          height: 100%; 
        
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
</style>
@endpush
@section('contents')
<div class="bground">
    
    <div class="card">
        <div class="card-body">
          This is some text within a card body.
        </div>
      </div>
       
    
      
</div>


@push('scripts')
@endpush
@endsection
