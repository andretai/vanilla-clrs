@extends('ms.layouts.app')

@section('content')
  <div>
    <form action="" method="POST">
      <div class="px-6 py-6 flex justify-between items-center border-b border-gray-300">
        <div class="flex">
          <a href="{{$back}}">Back</a>
          <p class="ml-6 font-semibold">Add a {{$item_type}}</p>
        </div>
        <div>
          <button class="px-3 py-2 rounded-sm bg-indigo-500 text-white">Save</button>
        </div>
      </div>
      <div class="w-2/3 mx-auto my-6">
        @foreach ($item_fields as $item_field)
          <label class="capitalize" for="{{$item_field->name}}">{{$item_field->name}}</label>
          <input class="my-3 p-2 w-full block border border-gray-300 rounded-sm font-semibold" type="{{$item_field->type}}" name="{{$item_field->name}}">
        @endforeach  
      </div>   
    </form>
  </div>
@endsection