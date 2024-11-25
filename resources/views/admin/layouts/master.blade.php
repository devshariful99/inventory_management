<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{config('app.name', 'Inventory Management')}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link
      rel="icon"
      href="{{asset('admin/assets/img/kaiadmin/favicon.ico')}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('admin/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    <link rel="stylesheet" href="{{asset('admin/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/kaiadmin.min.css')}}" />
    @stack('plugin-styles')
    <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- {{dd(session('success'))}} --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            @if (session('warning'))
                showAlert('warning', '{{ session('warning') }}');
            @endif
        });
    </script>
</head>
<body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('admin.partials.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel">
        @include('admin.partials.header')

        <div class="container">
          <div class="page-inner">
            @yield('content')
          </div>
        </div>

        @include('admin.partials.footer')
        
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('admin/assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('admin/assets/js/kaiadmin.min.js')}}"></script>
    @stack('plugin-js')
    <link rel="stylesheet" href="{{asset('admin/js/custom.js')}}">
    @stack('js')
  </body>
</html>
