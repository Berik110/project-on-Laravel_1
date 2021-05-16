<html>
<head>
    <title>Project on Laravel-1</title>
    @include('layout.header')
</head>
<body class="mb-1">
<div class="container-fluid">
    @include('layout.navbar')
{{--    @include('auth.login') Подключаем если будем пользоваться login через Модальное окно--}}
{{--    @include('auth.register') Подключаем если будем пользоваться register через Модальное окно--}}
</div>

<div class="container">
{{--    @include('admin.sidebar')--}}
    @yield('content')
</div>
</body>
<div class="container-fluid">
    @include('layout.footer')
</div>
@yield('custom.js')
</html>



