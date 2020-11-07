<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  @livewireStyles
</head>
<body>
  <div id="app">
    <nav>
      <div class="px-6 flex justify-between bg-red-500 text-white">
        <ul class="flex">
          <li class="pr-6 py-4"><a class="font-bold" href="{{ url('/ms') }}">clrs-ms</a></li>
          <li
            @if (Route::currentRouteName() !== 'ms-stats' && Route::currentRouteName() !== 'ms-sets')
              class="nav-top-links bg-red-400"
            @else
              class="nav-top-links"
            @endif
          ><a href="{{ route('ms-home') }}">Content</a></li>
          <li
            @if (Route::currentRouteName() === 'ms-stats')
              class="nav-top-links bg-red-400"
            @else
              class="nav-top-links"
            @endif
          ><a href="{{ route('ms-stats') }}">Statistics</a></li>
          <li
            @if (Route::currentRouteName() === 'ms-sets')
              class="nav-top-links bg-red-400"
            @else
              class="nav-top-links"
            @endif
          ><a href="{{ route('ms-sets') }}">Settings</a></li>
        </ul>
        <div class="grid grid-cols-2 col-gap-6">
          @guest
            <a class="py-4" href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
              <a class="py-4" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
          @else
            <a class="py-4" href="#">{{ Auth::user()->name }}</a>
            <div class="py-4">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          @endguest
        </div>
      </div>
    </nav>
    <main class="fixed h-full w-full grid grid-cols-6">
      <div class="col-span-1 bg-gray-800 text-white">
        <div class="pt-6">
          <a href="{{ url('/ms/courses') }}"
            @if (Route::currentRouteName() === 'ms-course')
              class="nav-side-links bg-gray-700"
            @else
              class="nav-side-links"
            @endif
          >Courses</a>
          <a href="{{ url('/ms/platforms') }}"
            @if (Route::currentRouteName() === 'ms-platform')
              class="nav-side-links bg-gray-700"
            @else
              class="nav-side-links"
            @endif
          >Platforms</a>
          <a href="{{ url('/ms/categories') }}"
            @if (Route::currentRouteName() === 'ms-category')
              class="nav-side-links bg-gray-700"
            @else
              class="nav-side-links"
            @endif
          >Categories</a>
          <a href="{{ url('/ms/promos') }}"
            @if (Route::currentRouteName() === 'ms-promo')
              class="nav-side-links bg-gray-700"
            @else
              class="nav-side-links"
            @endif
          >Promotions</a>
          <a href="{{ url('/ms/users') }}"
            @if (Route::currentRouteName() === 'ms-user')
              class="nav-side-links bg-gray-700"
            @else
              class="nav-side-links"
            @endif
          >Users</a>
        </div>
        <div class="fixed bottom-0 p-6">
          <p>Hello, Administrator !</p>
        </div>
      </div>
      <div class="col-span-5 overflow-auto overflow-y-scroll">
        @yield('content')
      </div>
    </main>
  </div>
  @livewireScripts
</body>
</html>