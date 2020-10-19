@extends('layouts.app')

@section('content')
<div class="container align-cen">
   <h1 class="p-2 m-1 font-bold text-3xl">Category</h1> 
<div class="flex flex-wrap">
        @foreach($categories as $category)
        <div class="bg-white rounded-md transition duration-500 ease-in-out w-56 m-3 hover:shadow-xl transform hover:-translate-y-1 hover:scare-110">
            <div>
                <img class="h-48 w-56 object-cover rounded-t-md" src="{{$category->image}}" alt="{{$category->category}}">
            </div>
            <p class="p-2 pb-5 font-bold .text-lg">{{$category->category}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection