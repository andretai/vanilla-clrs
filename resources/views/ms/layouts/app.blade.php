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
    <nav >
      <div id="navbar" class="flex justify-between bg-blue-500 text-white">
        <ul class="flex">
          <li class="px-6 py-4 flex justify-between items-center">
            <svg class="w-6 h-6 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V0L8.11 5.87 3 12h4v8L17 8h-4z"/></svg>
            <a class="font-bold" href="{{ url('/ms') }}">clrs-ms</a>
          </li>
          <li
            @if (
              Route::currentRouteName() !== 'ms-stats' && 
              Route::currentRouteName() !== 'ms-sets' &&
              Route::currentRouteName() !== 'ms-sets-seed' &&
              Route::currentRouteName() !== 'ms-sets-recommend' &&
              Route::currentRouteName() !== 'ms-sets-seed-confirm' &&
              Route::currentRouteName() !== 'ms-sets-recommend-move'
            )
              class="nav-top-links bg-blue-400 flex justify-between items-center"
            @else
              class="nav-top-links flex justify-between items-center"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.83 4H20v6h-1v10H1V10H0V4h5.17A3 3 0 0 1 10 .76 3 3 0 0 1 14.83 4zM8 10H3v8h5v-8zm4 0v8h5v-8h-5zM8 6H2v2h6V6zm4 0v2h6V6h-6zM8 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm4 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
            <a href="{{ route('ms-home') }}">Content</a></li>
          <li
            @if (Route::currentRouteName() === 'ms-stats')
              class="nav-top-links bg-blue-400 flex justify-between items-center"
            @else
              class="nav-top-links flex justify-between items-center"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M19.95 11A10 10 0 1 1 9 .05V11h10.95zm-.08-2.6H11.6V.13a10 10 0 0 1 8.27 8.27z"/></svg>
            <a href="{{ route('ms-stats') }}">Statistics</a></li>
          <li
            @if (
              Route::currentRouteName() === 'ms-sets' ||
              Route::currentRouteName() === 'ms-sets-seed' ||
              Route::currentRouteName() === 'ms-sets-recommend' ||
              Route::currentRouteName() === 'ms-sets-seed-confirm' ||
              Route::currentRouteName() === 'ms-sets-recommend-move'
            )
              class="nav-top-links bg-blue-400 flex justify-between items-center"
            @else
              class="nav-top-links flex justify-between items-center"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
            <a href="{{ route('ms-sets-seed') }}">Settings</a></li>
        </ul>
        <div class="flex items-center">
          <div class="flex items-center px-6">
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
            <a href="#">{{ Auth::user()->name }}</a>
          </div>
          <div class="flex items-center pr-6">
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z"/></svg>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </nav>
    <main class="fixed h-full w-full grid grid-cols-7">
      <div id="sidebar" class="col-span-1 bg-gray-800 text-white">
        <div class="pt-6">
          <a href="{{ url('/ms/courses') }}"
            @if (Route::currentRouteName() === 'ms-course')
              class="flex items-center pl-6 py-2 bg-gray-700"
            @else
              class="flex items-center pl-6 py-2"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 4H5a1 1 0 1 1 0-2h11V1a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-7v8l-2-2-2 2V4z"/></svg>
            <p>Courses</p>
          </a>
          <a href="{{ url('/ms/platforms') }}"
            @if (Route::currentRouteName() === 'ms-platform')
              class="flex items-center pl-6 py-2 bg-gray-700"
            @else
              class="flex items-center pl-6 py-2"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 1l10 6-10 6L0 7l10-6zm6.67 10L20 13l-10 6-10-6 3.33-2L10 15l6.67-4z"/></svg>
            <p>Platforms</p>
          </a>
          <a href="{{ url('/ms/categories') }}"
            @if (Route::currentRouteName() === 'ms-category')
              class="flex items-center pl-6 py-2 bg-gray-700"
            @else
              class="flex items-center pl-6 py-2"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 16v2H4v-2H0V4h4V2h12v2h4v12h-4zM14 5.5V4H6v12h8V5.5zm2 .5v8h2V6h-2zM4 6H2v8h2V6z"/></svg>
            <p>Categories</p>
          </a>
          {{-- <a href="{{ url('/ms/promotions') }}"
            @if (Route::currentRouteName() === 'ms-promotion')
              class="flex items-center pl-6 py-2 bg-gray-700"
            @else
              class="flex items-center pl-6 py-2"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 20v-1.7l.01-.24L15.07 12h2.94c1.1 0 1.99.89 1.99 2v4a2 2 0 0 1-2 2H9zm0-3.34V5.34l2.08-2.07a1.99 1.99 0 0 1 2.82 0l2.83 2.83a2 2 0 0 1 0 2.82L9 16.66zM0 1.99C0 .9.89 0 2 0h4a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zM4 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
            <p>Promotions</p>
          </a> --}}
          <a href="{{ url('/ms/users') }}"
            @if (Route::currentRouteName() === 'ms-user')
              class="flex items-center pl-6 py-2 bg-gray-700"
            @else
              class="flex items-center pl-6 py-2"
            @endif
          >
            <svg class="w-4 h-4 mr-3 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
            <p>Users</p>
          </a>
        </div>
        <div class="fixed bottom-0 p-6">
          <p>Hello, Administrator !</p>
        </div>
      </div>
      <div class="col-span-6 overflow-auto overflow-y-scroll">
        @yield('content')
      </div>
    </main>
  </div>
  @livewireScripts
</body>
</html>