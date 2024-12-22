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

    <script src="{{ asset('easyui/jquery.min.js') }}"></script>
    <script src="{{ asset('easyui/jquery.easyui.min.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="easyui-layout">
    <div data-options="region:'north',border:false" style="height:40px;padding:6px">
        <x-navbar />
    </div>
    <div data-options="region:'west',split:true,collapsed:false,title:'Navigasi'" style="width:200px;padding:10px;">
        <x-sidebar />
    </div>

    <!-- Content -->
    <div data-options="region:'center',title:''">
        <div class="easyui-tabs tabs-content" id="tabContent"
            data-options="fit:true,border:false,plain:true,cache:true">
            {{ $slot }}
        </div>
    </div>

    <script>
        function loadContent(title, url) {
            if ($("#tabContent").tabs("exists", title)) {
                $("#tabContent").tabs("select", title);
            } else {
                $("#tabContent").tabs("add", {
                    title: title,
                    closable: true,
                    href: url,
                });
            }
        }
    </script>
</body>

</html>
