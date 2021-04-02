<html>
<head>
    <title>Project on Laravel-1</title>
    @include('layout.header')
</head>
<body class="mb-5">
<div class="container-fluid">
    @include('layout.navbar')
    @include('auth.login')
    @include('auth.register')
</div>

<div class="container">
{{--    @include('admin.sidebar')--}}
    @yield('content')
</div>
</body>
<div class="container-fluid">
    @include('layout.footer')
</div>
</html>



