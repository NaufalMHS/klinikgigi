<!DOCTYPE html>
<html lang="en">

<head>

    @include('khusus.includes.frontsite.meta')

    <title>@yield('title') | MeetDoctor</title>

    @stack('before-style')
    @include('includes.frontsite.style')
    @stack('after-style')

</head>

<body>

    @include('sweetalert::alert')

    @include('khusus.components.frontsite.header')
    @yield('content')

    @include('khusus.components.frontsite.footer')

    @stack('before-script')
    @include('khusus.includes.frontsite.script')
    @stack('after-script')

    {{-- modals --}}
    {{-- if you have a modal, create here --}}

</body>

</html>