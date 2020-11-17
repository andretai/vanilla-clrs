<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e460f14c9c.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>

<body class="bg-gray-200">
    <div id="app">
        <nav class="flex items-center justify-between flex-wrap bg-white px-4 p-3">
            <div class="flex items-center flex-shrink-0 text-indigo-700 mr-6">
                <i class="fas fa-book-open fa-2x mr-2"></i>
                <span class="font-bold text-xl tracking-tight">CLRS</span>
            </div>
            <!-- Hidden Menu for small screen -->
            <div class="block lg:hidden">
                <button class="flex items-center px-3 py-2 border rounded text-red-400 border-indigo-700 hover:text-indigo-400 hover:border-indigo-800">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
                    <a href="/home" class="{{'home' == request()->path() ? 'font-bold' : '' }} text-lg block mt-4 lg:inline-block lg:mt-0 text-indigo-700 hover:text-indigo-600 mr-4">
                        Home
                    </a>
                    <a href="/course" class="{{'course' == request()->path() ? 'font-bold' : '' }} text-lg block mt-4 lg:inline-block lg:mt-0  text-indigo-700 hover:text-indigo-600 mr-4">
                        Course
                    </a>
                    <a href="/favourite" class="{{'favourite' == request()->path() ? 'font-bold' : '' }} text-lg block mt-4 lg:inline-block lg:mt-0 text-indigo-700 hover:text-indigo-600 mr-4">
                        Favourite <span class=" rounded-full bg-indigo-700 uppercase px-2 py-1 text-xs text-white font-bold mr-3">{{$favCount}}</span>
                    </a>
                    
                    </a>
                    <a href="/promotion" class="{{'promotion' == request()->path() ? 'font-bold' : '' }} text-lg block mt-4 lg:inline-block lg:mt-0 text-indigo-700 hover:text-indigo-600">
                        Promotion
                    </a>
                </div>
                <div>
                    @guest
                    <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-indigo-700 border-indigo-700 hover:border-transparent hover:bg-indigo-500 mt-4 mr-3 lg:mt-0">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-indigo-700 border-indigo-700 hover:border-transparent hover:bg-indigo-500 mt-4 lg:mt-0">{{ __('Register') }}</a>
                    @endif
                    @else
                    <a href="#responsive-header" class="inline-block uppercase rounded-full px-4 py-2 text-xl  text-white font-bold lg:mt-0 mr-4 bg-indigo-700 hover:text-white ">
                        {{ substr(Auth::user()->name,0,1) }}
                    </a>
                    <a class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-indigo-700 hover:border-transparent  hover:bg-indigo-500 mt-4 lg:mt-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                    @endguest
                </div>
            </div>
        </nav>
        <!-- Authentication Links -->

    </div>

    <main>
        @yield('content')
    </main>
    @livewireScripts
    @yield('scripts')
</body>

</html>