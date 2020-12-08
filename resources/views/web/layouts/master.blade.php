<!DOCTYPE html>
<html>
<head>
    <title>YELLOW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <link href="{{asset('web/Chawalah.css')}}" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="{{asset('web/css/fakeloader.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('web/css/fonts.css')}}" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('web/js/swipe.js')}}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    <script src="{{asset('web/js/fakeloader.js')}}"></script>
    

@stack('style')
</head>
<body>
    
    @yield('contents')

    @stack('scripts')


</body>
</html>
