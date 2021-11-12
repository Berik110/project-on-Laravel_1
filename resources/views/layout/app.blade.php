<html>
    <head>
        <title>Аренда, Продажа Спец.техники и Оборудования</title>
        @include('layout.header')
    </head>
<body class="">
    <div class="container-fluid">
        @include('layout.navbar')
    {{--    @include('auth.login') Подключаем если будем пользоваться login через Модальное окно--}}
    {{--    @include('auth.register') Подключаем если будем пользоваться register через Модальное окно--}}
    </div>

    <div class="container">
    {{--    @include('admin.sidebar')--}}
        @yield('content')
    </div>
    <script src="{{asset('jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('bootstrap-4.6.0-dist/js/bootstrap.js')}}"></script>
</body>
    <div class="container-fluid">
        @include('layout.footer')
    </div>
    @yield('custom.js')
</html>



