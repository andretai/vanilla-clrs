@extends('layouts.app')

@section('content')
<div class=" flex flex-wrap ">
    @foreach( $courses as $course)
    <div class="mt-6 px-2 w-1/5">
        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
            <img class="h-48 w-full object-cover" src="{{$course->image}}" alt="{{$course->description}}">
            <div class="p-6">
                <div class="flex items-baseline">
                    <span class="inline-block bg-teal-200 text-teal-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">new</span>
                    <div class="ml-2 text-gray-600 text-xs uppercase font-semibold truncate">
                        {{$course->category}}
                    </div>
                </div>

                <h4 class="mt-1 font-semibold text-lg leading-tight truncate">{{ $course->title }}</h4>

                <div class="text-gray-600 text-xs uppercase font-semibold truncate">
                    By: Andre Tai
                </div>
                <div class="flex items-baseline">
                    <span class="inline-block text-teal-800 text-xs uppercase font-semibold tracking-wide pr-1">{{$course->platform}}</span>
                    <div class="mt-3 text-teal-800 text-xs uppercase font-semibold tracking-wide">
                        &bull; {{ $course->price }}
                    </div>
                </div>
                <div class="mt-2 flex items-center">
                    <span class="text-gray-600 text-sm">200 likes</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
<div class="d-flex justify-content-center pt-2">
    {{ $courses->appends(request()->query())->links() }}
</div>
@endsection