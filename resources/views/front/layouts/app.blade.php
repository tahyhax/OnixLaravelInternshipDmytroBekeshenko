<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>
    <link rel="stylesheet" href="{{mix('css/front/app.css')}}">

    @livewireStyles

    @stack('styles')
</head>
<body>

@include('front.layouts.partials.header._header', ['companyName' => 'InternShipPhp'])

<div class="container">

    @include('front.blocks.notice.message-session')

    <div class="row">

        @yield('sidebar-left')
        @yield('content')

    </div>
</div>

@livewireScripts
<script src="{{mix('js/front/app.js')}}"></script>

</body>
</html>


