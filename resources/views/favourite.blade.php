@extends('layouts.app')

@section('content')
<div class="max-w-md sm:max-w-xl lg:max-w-6xl mx-auto px-10 lg:px-0 py-8">
    <h2 class="text-2xl pl-6 text-gray-900 font-semibold pt-8">Favourite</h2>
    @if (session('alert'))
    <div class="m-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
        <p>{{ session('alert') }}</p>
    </div>
    @endif

    @foreach($favourites as $favourite)
    <div class="flex rounded-lg m-3">
        <div class="w-1/3 bg-white rounded-lg m-2 p-2 items-center">
            <div>
                <img class="overflow-hidden h-auto w-full rounded-lg object-cover" src="{{$favourite->course->image}}" :alt="">
            </div>
        </div>
        <div class="w-2/3 bg-white rounded-lg m-2 p-5">
            <div class="flex justify-between">
                <div>

                    <h2 class="pl-2 font-bold text-2xl text-gray-900">{{$favourite->course->title}}</h2>
                    <p class="pl-2 mt-3 font-base text-xl text-gray-600 tracking-wide">{{$favourite->course->category}} &bull; Created
                        by: Andre Tai</p>
                    <p class="pl-2 italic monospaced text-gray-600 text-xl">Duration: 5 Hours</p>
                    <p class="pl-2 italic monospaced text-gray-600 text-xl">Platform: {{$favourite->course->platform}}</p>

                    <p class="pl-2 italic monospaced text-gray-600 text-xl ">Price: {{$favourite->course->price}}</p>
                </div>
                <div>
                    <p class="mb-10"><a href="favourite/removefav/{{$favourite->id}}" class="mt-4 p-3 bg-red-700 hover:bg-blue-600 text-l rounded-lg uppercase text-white justified text-center font-bold tracking-wide">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </p>
                    <p><a href="course/{{$favourite->id}}" class="mt-4 p-3 pl-4 pr-4 bg-blue-700 hover:bg-blue-600 text-l rounded-lg uppercase text-white justified text-center font-bold tracking-wide">
                            <i class="fas fa-info"></i>
                        </a></p>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>
@endsection

@section('scripts')

@endsection