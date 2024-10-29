<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('easyui/themes/bootstrap/easyui.css') }}" rel="stylesheet">
    <link href="{{ asset('easyui/themes/icon.css') }}" rel="stylesheet">
    <link href="{{ asset('easyui/themes/color.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="easyui-layout">
    <div data-options="region:'west',split:true" title="{{ config('app.name') }}" style="width:200px;">
        <x-sidebar />
    </div>
    <div data-options="region:'center'">
        {{ $slot }}
    </div>

    <script src="{{ asset('easyui/jquery.min.js') }}"></script>
    <script src="{{ asset('easyui/jquery.easyui.min.js') }}"></script>
</body>

</html>
