<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="{{ asset('back/layui/css/layui.css?v=1.0.9') }}" media="all">
    <link rel="stylesheet" href="{{ asset('back/layui/css/global.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('back/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('back/css/main.css?v1.3.3') }}" media="all">
    @yield('style')
    <script>
        window.conf ={
            APP:'{{env("APP_URL")}}',
            SUFFIX:'',
            'TOKEN': "{{csrf_token()}}"
        }
    </script>
</head>

<body>
    @yield('content')
</body>
<script src="{{ asset('back/layui/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('back/vue.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('back/axios.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('back/aizxin.js') }}" charset="utf-8"></script>
<script>
    layui.config({
        base: "{{ asset('back/layui') }}/"
    })
</script>
@yield('my-js')
</html>