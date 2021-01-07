@extends('layouts.app')

@section('content')
<div class="">
    <div class="bg-indigo-700 px-32 p-10">
        <h2 class="text-4xl text-white font-semibold pt-8">Favourite</h2>
    </div>
    @if(!$favourites->isEmpty())
    <div class="px-24 p-10">
        @if (session('alert'))
        <div class="m-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
            <p>{{ session('alert') }}</p>
        </div>
        @endif
        <div class="divide-y divide-black">
            @foreach($favourites as $favourite)

            <div class="flex py-3">
                <div class="">
                    <a href="course/{{$favourite->course_id}}">
                        <img class="overflow-hidden h-auto w-64 object-cover" src="{{$favourite->course->image}}" :alt="">
                    </a>
                </div>
                <div class="px-5 w-3/5">
                    <a href="course/{{$favourite->course_id}}">
                        <h2 class=" font-bold text-2xl text-gray-900">{{$favourite->course->title}}</h2>
                        <div class="flex mt-1">
                            <p class="pr-5 font-semibold text-lg">{{$favourite->course->instructor}}</p>
                            <p class="font-semibold text-orange-600 text-lg">{{$favourite->course->avgRating()}}<i class="fas fa-star fa-sm pl-3"></i></p>
                        </div>
                        <p class="text-xl capitalize"><i class="fas fa-window-restore fa-sm mr-2"></i> {{$favourite->course->platform->platform}}</p>
                    </a>
                </div>
                <div class="px-5">
                    <p class="text-xl font-semibold pt-1 ">{{$favourite->course->price}}</p>
                </div>
                <div class="px-5 pt-2">
                    <p><a href="favourite/removefav/{{$favourite->id}}" class="hover:text-red-400 text-red-700">
                            <i class="fas fa-trash-alt fa-lg"></i>
                        </a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pt-5">
            {{ $favourites->appends(request()->query())->links() }}
        </div>
    </div>
    <div class="pt-10 px-10">
        <!-- Recommendation -->
        <div>
            <h2 class="px-10 font-bold text-2xl text-gray-900">People also looking for</h2>
            <div class="px-10 pt-4 w-full md:w-3/5 mb-6 md:mb-0">
                <form action="/favourite" method="GET" role="change">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-state">
                        Recommend course based on your favourite list
                    </label>
                    <div class="inline-block relative mr-5">
                        <select class="block appearance-none w-full bg-gray-300 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="favourite" id="favourite">
                            @foreach($favouritesRec as $favourite)
                            <option value="{{$favourite->course_id}}" @if(session('forms.fav')==$favourite->course_id) selected="selected" @endif>{{$favourite->course->title}}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                        </div>
                    </div>
                    <div class="inline-block">
                        <button class="shadow bg-indigo-700 hover:bg-indigo-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Change
                        </button>
                    </div>
                </form>
            </div>
            @if(!$favourites->recommendCourse)
            <div class="flex pb-10">
                @foreach($favourites->recommendCategoryCourse as $course)
                <a class="mt-6 px-2 w-64" href="/course/{{$course->id}}">
                    <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
                        <img class="h-48 w-full object-cover" src="{{$course->image}}" alt="{{$course->description}}">
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span class="inline-block bg-teal-200 text-teal-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">{{$course->platform->platform}}</span>
                                <div class="ml-2 text-gray-600 text-xs uppercase font-semibold truncate">
                                    {{$course->category->category}}
                                </div>
                            </div>

                            <h4 class="mt-1 font-semibold text-lg leading-tight truncate">{{ $course->title }}</h4>

                            <div class="flex mt-1">
                                <div class="text-gray-600 capitalize w-24 font-semibold truncate">
                                    {{$course->instructor}}</div>
                                <div class="text-orange-600 ml-3">{{$course->avgRating()}} <i class="fas fa-star fa-sm pl-1"></i></div>
                            </div>
                            <div class="flex items-baseline">
                                <div class="mt-2 text-red-700 text-lg font-semibold tracking-wide">
                                    {{ $course->price }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="flex pb-10">
                @foreach($favourites->recommendCourse as $course)
                <a class="mt-6 px-2 w-64" href="/course/{{$course->course->id}}">
                    <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
                        <img class="h-48 w-full object-cover" src="{{$course->course->image}}" alt="{{$course->course->description}}">
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span class="inline-block bg-teal-200 text-teal-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">{{$course->course->platform->platform}}</span>
                                <div class="ml-2 text-gray-600 text-xs uppercase font-semibold truncate">
                                    {{$course->course->category->category}}
                                </div>
                            </div>

                            <h4 class="mt-1 font-semibold text-lg leading-tight truncate">{{ $course->course->title }}</h4>

                            <div class="flex mt-1">
                                <div class="text-gray-600 capitalize w-24 font-semibold truncate">
                                    {{$course->course->instructor}}</div>
                                <div class="text-orange-600 ml-3">{{$course->course->avgRating()}} <i class="fas fa-star fa-sm pl-1"></i></div>
                            </div>
                            <div class="flex items-baseline">
                                <div class="mt-2 text-red-700 text-lg font-semibold tracking-wide">
                                    {{ $course->course->price }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
        @else
        <div class="px-32 p-10">
            <div class="mx-auto h-full flex justify-center items-center pb-5"><i class="fas fa-book fa-7x text-indigo-700"></i></div>
            <div class=" mx-auto h-full flex justify-center items-center text-3xl font-bold">No Course is Found</div>
            <div class=" mx-auto h-full flex justify-center items-center text-2xl font-semibold">Lets Add Some Course to Your Favourite List</div>
            <div class="flex justify-center items-center py-5">
                <a href="/course" target="_blank" class=" text-lg px-3 py-4 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">
                    Get Some At Course Page<i class="fas fa-info-circle ml-2">
                    </i></a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')

@endsection